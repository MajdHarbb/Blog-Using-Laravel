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

    public function edit($id)
    {
        $post = BlogPost::find($id);
        return view('edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->picture);
        BlogPost::where('id',$request->id)->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        if($request->picture != null) {
            $imageName = time().'.'.$request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
            BlogPost::where('id',$request->id)->update([
                'picture' => $imageName
            ]);
        }

        return redirect('edit/' . $request->id)->with('message', 'Post was updated successfully!');
    }

    public function destroy(BlogPost $blogPost, Request $request)
    {   
        $res=BlogPost::where('id',$request->id)->delete();
        return redirect()->back()->with('message', 'Post was deleted successfully!');
    }

    // public function search(Request $request){
    //     $search = $request->search;
    
    //     $posts = BlogPost::query()
    //         ->where('title', 'LIKE', "%{$search}%")
    //         ->orWhere('body', 'LIKE', "%{$search}%")
    //         ->get();
        
    //     return view('search', compact('posts'));
    // }
}
