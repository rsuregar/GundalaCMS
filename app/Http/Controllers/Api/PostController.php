<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    //

    public function index()
    {
        return Post::with('author', 'editor', 'categories')->get();
    }
}
