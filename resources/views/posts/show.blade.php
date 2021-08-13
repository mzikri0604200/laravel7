@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 shadow">
                <h1 class="pt-lg-3">{{ $post->title }}</h1>
                
                <small>Category : 
                    <a href="/categories/{{ $post->category->slug }}" class="text-secondary bg-light p-1 rounded">{{ $post->category->name }}</a>
                    &middot;
                    <span class="text-secondary">{{$post->created_at->format("d F, Y")}}</span> 
                    &middot;
                    @foreach ($post->tags as $tag)
                        <a href="/tags/{{ $tag->slug }}" class="btn btn-sm text-secondary">{{ $tag->name }}</a>
                    @endforeach
                </small>

                <p class="text-info m-0">
                  Wrote By : {{$post->author->name}}
                </p>

                @if ($post->thumbnail)
                    <img src="{{ asset($post->takeImage()) }}" class="img-fluid my-3" width="100%" >
                @else
                    <img src="{{ asset("/storage/images/posts/notfound.jpg") }}" class="img-fluid my-3" width="100%">
                @endif

                <p class="text-justify">{!! nl2br($post->body) !!}</p> 
 
                <div class="d-flex flex-row pb-3">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                        {{-- @can ('update', $post) --}}
                        {{-- @endcan --}}
    
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Delete
                        </button>
                    @endcan
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin anda ingin menghapusnya ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>{{ $post->title }}</h5>
                        <p class="mt-3 text-secondary">
                            Published on {{$post->created_at->format("d F, Y")}}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form action="/posts/{{ $post->slug }}/delete" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-primary" type="submit">Ya</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <p class="text-info">
            Wrote By : {{$post->author->name}}
        </p> --}}
        
    </div>
@endsection