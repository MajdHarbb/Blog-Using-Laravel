<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('create');
    }

    public function create(Request $request)
    {        
        $imageName = time().'.'.$request->picture->extension();
        $request->picture->move(public_path('images'), $imageName);

        $post = BlogPost::create([
            'title' => $request['title'],
            'user_id' => $request['user_id'],
            'body' => $request['body'],
            'picture' => $imageName,
        ]);
        return redirect('add-post')->with('message', 'Blog Post was created successfully!');
    }
}
