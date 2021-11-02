<?php

namespace App\Http\Controllers;

use App\BlogComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogCategory;
use App\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $blogs = Blog::orderBy('created_at', 'desc');

        if ($request->search != null){
            $blogs = $blogs->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $blogs = $blogs->paginate(15);

        return view('backend.blog_system.blog.index', compact('blogs','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_categories = BlogCategory::all();
        return view('backend.blog_system.blog.create', compact('blog_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
        ]);

        $blog = new Blog;

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->banner = $request->banner;
        $blog->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;

        $tags = array();
        if($request->tags[0] != null){
            foreach (json_decode($request->tags[0]) as $key => $tag) {
                array_push($tags, $tag->value);
            }
        }
        $blog->tags = implode(',', $tags);

        $blog->meta_title = $request->meta_title;
        $blog->meta_img = $request->meta_img;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;

        $blog->save();

        flash(translate('Blog post has been created successfully'))->success();
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        $blog_categories = BlogCategory::all();

        return view('backend.blog_system.blog.edit', compact('blog','blog_categories'));
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
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
        ]);

        $blog = Blog::find($id);

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->banner = $request->banner;
        $blog->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;

        $tags = array();
        if($request->tags[0] != null){
            foreach (json_decode($request->tags[0]) as $key => $tag) {
                array_push($tags, $tag->value);
            }
        }
        $blog->tags = implode(',', $tags);

        $blog->meta_title = $request->meta_title;
        $blog->meta_img = $request->meta_img;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;

        $blog->save();

        flash(translate('Blog post has been updated successfully'))->success();
        return redirect()->route('blog.index');
    }

    public function change_status(Request $request) {
        $blog = Blog::find($request->id);
        $blog->status = $request->status;

        $blog->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete();

        return redirect('admin/blogs');
    }


    public function all_blog(Request $request) {
        $blogs = Blog::where('status', 1);
        if($request->has('category')) {
            if($request->category != ""){
                $blogs = $blogs->where('category_id', $request->category);
            }
        }
        if($request->has('search')) {
            if($request->search != ""){
                $blogs = $blogs->where('title', 'LIKE', "%{$request->search}%")
                                ->orWhere('tags', 'LIKE', "%{$request->search}%");
            }
        }
        if ($request->has('tag')) {
            if ($request->tag != ""){
                $blogs = $blogs->where('tags', $request->tag);
            }
        }
        $blogs = $blogs->orderBy('created_at', 'desc')->paginate(12);
        // return view("frontend.blog.listing", compact('blogs'));
        return view("n_frontend.blog.blogs", compact('blogs'));
    }

    public function blog_details($slug) {
        $blog = Blog::with(['comments'=>function($query) {
                $query->with('user');
        }])->where('slug', $slug)->first();

        Blog::where('id', $blog->id)->update(['total_views' => $blog->total_views+1]);

        return view("n_frontend.blog.details", compact('blog'));
    }

    public function blog_comment($id, Request $request)
    {
        $blogComment = new BlogComment();
        $blogComment->user_id = Auth::user()->id;
        $blogComment->blog_id = $id;
        $blogComment->comment = $request->comment;
        $blogComment->save();
        return back();
    }
    // public function latest_blog()
    // {
    //     $latest_blog = Blog::orderBy('created_at', 'desc')->take(12)->get();
    //     // dd($latest_blog);
    //     return view("n_frontend.blog.blog__3", compact('latest_blog'));
    // }
}
