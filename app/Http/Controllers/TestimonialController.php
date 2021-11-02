<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;

        $testimonials = Testimonial::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $testimonials = $testimonials->where('client_name', 'like', '%'.$sort_search.'%');
        }
        $testimonials = $testimonials->paginate(15);
        return view('backend.testimonials.index', compact('testimonials', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $testimonial = new Testimonial;
        $testimonial->client_name = $request->client_name;
        $testimonial->designation = $request->designation;
        $testimonial->opinion = $request->opinion;
        $testimonial->client_photo = $request->client_photo;
        $testimonial->save();

        flash(translate('Testimonial has been inserted successfully'))->success();
        return redirect()->route('testimonials.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->client_name = $request->client_name;
        $testimonial->designation = $request->designation;
        $testimonial->opinion = $request->opinion;
        $testimonial->client_photo = $request->client_photo;
        $testimonial->save();

        flash(translate('Testimonial has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        flash(translate('Testimonial has been deleted successfully'))->success();
        return redirect()->route('testimonials.index');
    }
 
}
