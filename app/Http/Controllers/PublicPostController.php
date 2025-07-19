<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('welcome', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('welcome_show', compact('post'));
    }
}
