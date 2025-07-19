<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function userList()
    {
        if (Session::get('user') !== 'avanishpatel3434@gmail.com') {
            return redirect('/login')->with('error', 'Access denied.');
        }

        $users = User::all();

        $usersData = $users->map(function ($user) {
            $posts = Post::where('author', $user->email)->get();
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'post_count' => $posts->count(),
                'latest_post_date' => $posts->max('created_at'),
            ];
        });

        return view('admin.users', compact('usersData'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        Post::where('author', $user->email)->delete();

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted.');
    }
}
