<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactMailManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $sort_search =null;

        $contacts = Contact::orderBy('created_at', 'desc');

        if ($request->has('search')){
            $sort_search = $request->search;
            $contacts = $contacts->where('email', 'like', '%'.$sort_search.'%');
        }
        $contacts = $contacts->paginate(15);

        return view ('backend.contact.index', compact('contacts', 'sort_search'));
    }

    public function create()
    {   
        return view ('n_frontend.contact');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/([8]{2})?(01)[3-9]{1}[0-9]{8}$/',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        try{
           $contact = new Contact();
           $contact->name = $request->name;
           $contact->email = $request->email;
           $contact->phone = $request->phone;
           $contact->subject = $request->subject;
           $contact->message = $request->message;
           $data = $contact;

           if ($contact->save()) {
               $this->send_message_to_seller($data);
           }

           flash(translate('Message sent. Check your email for reply'))->success();
           return redirect()->route('contact.create');
        } catch (\Exception $exception) {
            flash('Message sending failed')->error();

            return redirect()->route('contact.create');
        }
    }

    public function send_message_to_seller($data)
    {
        $array['view'] = 'emails.contact';
        $array['subject'] = $data->subject;
        $array['from'] = $data->email;
        $array['content'] = 'Hi! You recieved a message from '.$data->email.'.';
        $array['sender'] = $data->name;
        $array['details'] = $data->message;

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new ContactMailManager($array));
        } catch (\Exception $e) {
            // $e->getMessage();
            flash(translate('Message sent'))->success();
        }
    }

    public function show(Contact $contact)
    {
        //
    }

    public function edit(Contact $contact)
    {
        //
    }

    public function update(Request $request, Contact $contact)
    {
        //
    }

    public function destroy(Contact $contact)
    {
        //
    }
}
