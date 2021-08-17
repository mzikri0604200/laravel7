<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $taks = Tag::get();
        $kategories = Category::with('author', 'tags', 'category')->where('category_id', $category->category_id)->latest()->limit(6);
        $posts = $category->posts()->latest()->paginate(6);
           $kategories = Category::get();
        return view('posts.index', compact('posts','category','kategories', 'taks'));
    }
}
