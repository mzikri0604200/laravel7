<?php

namespace App\Http\Controllers;
use Str;
use App\{Post, Category, Tag};
use Illuminate\Http\Request;


class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except([
    //         'index',
    //         'show',
    //     ]);
    // }

    public function index()
    {
        // $posts = Post::get();
        // $posts = Post::take(5)->get();
        // $posts = Post::paginate(2);

        // $posts = Post::simplePaginate(5);
        // return view('posts.index', ['posts' => $posts]);
        // return view('posts.index', compact('posts'));

        return view('posts.index',[
            // 'posts' => Post::paginate(3),
            'posts' => Post::latest()->paginate(3),
        ]);

    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        // return view('posts.create');
        return view('posts.create', [
            'post' => new Post(),
            'categories' => Category::get(),
            'tags' => Tag::get(), 
        ]);
    }

    public function store(Request $request)
    {
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = Str::slug($request->title); 
        // $post->body = $request->body;
        // $post->save();
        // return redirect()->to('posts');


        // Post::create([
        //     'title' => $request->title,
        //     'slug' => Str::slug($request->title),
        //     'body' => $request->body,
        // ]);

        // $this->validate($request, [
        //     'title' => 'required|min:3',
        //     'body' => 'required',
        // ]);

        // $request->validate([
        //     'title' => 'required|min:3',
        //     'body' => 'required',
        // ]);
        // $post = $request->all();
        // $post['slug'] = Str::slug($request->title);
        // Post::create($post);

        $attr = $request->validate([
            'title' => 'required|min:3',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required',
        ]);

        $attr['slug'] = Str::slug($request->title);

        $attr['category_id'] = request('category');

        $post = Post::create($attr);
        
        $post->tags()->attach(request('tags')); 

        // session()->flash('error', 'the post was not created');
        session()->flash('success', 'The post was created');


        // return back();
        return redirect()->to('posts');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }

    public function update(Post $post, Request $request)
    {
        $attr = $this->validateRequest();
        $attr['category_id'] = request('category');

        $post->update($attr);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'The post was updated');

        return redirect()->to('posts');

    }

    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        session()->flash('success', 'The post was Deleted');

        return redirect('posts');
    }

    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|min:3',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required',
        ]);
    }
    
    // public function show($slug)
    // {
    //     // $post = \DB::table('posts')->where('slug',  $slug)->first(); 
    //     $post = Post::where('slug',  $slug)->firstOrFail(); 
    //     // dd($post);

    //     // if(!$post){
    //     //     abort(404);
    //     // }

    //     return view('posts.show', compact('post'));
    // }
}
