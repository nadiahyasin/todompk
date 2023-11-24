<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
class PostController extends Controller
{
    function index() {
        // $posts = Post::all(); // SELECT * FROM posts

        $posts = Post::latest()->paginate(15);

        // dd($posts);
        return view('posts.index', compact('posts'));

    }

    function show(Post $post) {

        return view('posts.show', compact('post'));
    }

    function create() {
        return view('posts.create');
    }

    function store(Request $request) {
        $request->validate([
            'title'=>'required|min:10',
            'content'=>'required'
        ],[
           'title.required'=>'Sila isi ruangan tajuk',
           'title.min'=>'Tajuk mestilah sekurang-kurangnya 10 aksara',
            'content.required'=>'Sila isi ruangan kandungan'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('post.index');
    }

    function delete(Post $post) {
        $post->delete();

        flash('Post anda telah berjaya dipadam')->success()->important();
        //success - hijau
        //error - merah
        //warning - kuning
        return redirect()->route('post.index');
    }

    function edit(Post $post){
        return view('posts.create', compact('post'));
    }

    function update(Request $request, Post $post) {
        $request->validate([
            'title'=>'required|min:10',
            'content'=>'required'
        ],[
           'title.required'=>'Sila isi ruangan tajuk',
           'title.min'=>'Tajuk mestilah sekurang-kurangnya 10 aksara',
            'content.required'=>'Sila isi ruangan kandungan'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        flash('Updated successfully')->success()->important();
        return redirect()->route('post.index');
    }
}
