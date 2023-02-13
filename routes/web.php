<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\BlogPost;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $posts = BlogPost::paginate(5);
    if($request->search != null && $request->search != ""){
        $posts = BlogPost::query()
            ->where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('body', 'LIKE', "%{$request->search}%")
            ->paginate(5);
                    
        return view('welcome', [
            'posts' => $posts,
            'tsearch' => $request->search
        ]);
    }
    return view('welcome', [
        'posts' => $posts,
    ]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/add-post', [App\Http\Controllers\BlogPostsController::class, 'index'])->name('add-post');
Route::post('/create-post', [App\Http\Controllers\BlogPostsController::class, 'create'])->name('create-post');
Route::get('/edit/{blogPost}', [\App\Http\Controllers\BlogPostsController::class, 'edit']);
Route::put('/edit/{blogPost}', [\App\Http\Controllers\BlogPostsController::class, 'update']);
Route::delete('/edit/{blogPost}', [\App\Http\Controllers\BlogPostsController::class, 'destroy']);