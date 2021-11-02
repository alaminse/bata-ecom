<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailManager extends Mailable
{
    use Queueable, SerializesModels;

    public $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function build()
    {
        return $this->view('emails.contact')
            ->from($this->array['from'], env('MAIL_FROM_NAME'))
            ->subject($this->array['subject'])
            ->with([
                'content' => $this->array['content'],
//                'link' => $this->array['link'],
                'sender' => $this->array['sender'],
                'details' => $this->array['details']
            ]);
    }
}
