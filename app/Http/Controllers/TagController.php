<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $kategories = Category::get();
        $taks = Category::with('author', 'tags', 'category')->where('tag_id', $tag->tag_id)->latest()->limit(6);
        $taks = Tag::get();
        $posts = $tag->posts()->latest()->paginate(6);
        return view('posts.index', compact('posts','tag', 'kategories', 'taks'));
    }
}
