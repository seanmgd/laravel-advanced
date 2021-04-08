<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }
}
