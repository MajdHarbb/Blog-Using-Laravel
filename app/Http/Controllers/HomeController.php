<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class HomeController extends Controller
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
        $posts = BlogPost::paginate(5);
        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function search(Request $request){
        $search = $request->search;
        
        $posts = BlogPost::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('body', 'LIKE', "%{$search}%")
            ->paginate(5);
                    
        return view('home', [
            'posts' => $posts,
            'tsearch' => $search
        ]);
    }
}
