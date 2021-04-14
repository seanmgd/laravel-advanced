<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function index()
    {
        $posts = Post::allPosts();

        return view('post.index', compact('posts'));
    }
}
