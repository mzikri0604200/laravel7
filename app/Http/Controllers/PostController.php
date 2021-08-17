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
            // 'posts' => Post::latest()->paginate(4),
            'kategories' => Category::get(),
            'taks' => Tag::get(),
            'posts' => Post::with('author', 'tags', 'category')->latest()->paginate(4),
        ]);

    }

    public function show(Post $post)
    {
    
        $kategories = Category::with('author', 'tags', 'category')->where('category_id', $post->category_id)->latest()->limit(6);
        $posts = Post::with('author', 'tags', 'category')->where('category_id', $post->category_id)->latest()->limit(6);
        return view('posts.show', compact('post', 'posts', 'kategories'));
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
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $slug = Str::slug($request->title);
        $attr['slug'] = $slug;

        if (request()->file('thumbnail')) {
            $thumbnail = request()->file('thumbnail');
            // $thumbnailUrl = $thumbnail->storeAs("images/posts", "{$slug}.{$thumbnail->extension()}");
            $thumbnailUrl = $thumbnail->store("images/posts");
        } else {
            $thumbnailUrl = NULL;
        }

        // $thumbnail = request()->file('thumbnail');
        // // $thumbnailUrl = $thumbnail->storeAs("images/posts", "{$slug}.{$thumbnail->extension()}");
        // $thumbnailUrl = $thumbnail->store("images/posts");

        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnailUrl;

        // $attr['user_id'] = auth()->id();

        // $post = Post::create($attr);
        $post = auth()->user()->posts()->create($attr);

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
        $this->authorize('update', $post);

        // replace asset in folder storage 
        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        } else {
            $thumbnail = $post->thumbnail;
        }

        // $thumbnail = request()->file('thumbnail');
        // $thumbnailUrl = $thumbnail->store("images/posts");

        $attr = $this->validateRequest();
        $attr['category_id'] = request('category');

        $attr['thumbnail'] = $thumbnail;

        $post->update($attr);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'The post was updated');

        return redirect()->to('posts');

    }

    public function destroy(Post $post)
    {
        // menghapus post sesuai user
        $this->authorize('delete', $post);

        // Delete asset Storage img 
        \Storage::delete($post->thumbnail);

        // Delete tags
        $post->tags()->detach();

        // Delete Post
        $post->delete();


        // Alert
        session()->flash('error', 'The post was deleted');
        return redirect('posts');


        // if (auth()->user()->is($post->author)) {
        //     $post->tags()->detach();
        //     $post->delete();
        //     session()->flash('success', 'The post was Deleted');
        //     return redirect('posts');
        // } else {
        //     session()->flash('error', "It wasn't your post");
        //     return redirect('posts');
        // }        
    }

    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|min:3',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
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
