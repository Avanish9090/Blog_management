<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function myPosts()
    {
        $userEmail = Session::get('user');
        $posts = Post::where('author', $userEmail)->get();
        return view('posts.my', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;



        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }



        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => Session::get('user'),
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.my')->with('success', 'Post created!');
    }




    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $post = Post::findOrFail($id);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);

        return redirect('/my-posts')->with('success', 'Post updated!');
    }


    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.my')->with('success', 'Post deleted!');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('posts', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
