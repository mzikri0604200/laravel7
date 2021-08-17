<?php

namespace App\Http\Controllers;

use App\{Post, Category, Tag};
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post()
    {
        
        $kategories = Category::get();
        $taks = Tag::get();
        $query = request('query');
        $posts = Post::where('title', 'like', "%$query%")->latest()->paginate(4);
        return view('posts.index', compact('posts', 'taks', 'kategories'));
    }
}
