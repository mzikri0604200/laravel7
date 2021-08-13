@extends('layouts.app')

@section('content')
		<div class="container">
			<div class="row mb-2">
				<div class="col-lg-6 col-12 ">
					@isset($category)
						<h4>
							Category : {{$category->name}}
						</h4>
					@endisset
					
					@isset($tag)
						<h4>
							Tag : {{ $tag->name }}
						</h4>
					@endisset

					@if (!isset($tag) && !isset($category))
						<h4>All Post</h4>
					@endif
				</div>
				{{-- <div class="col-lg-6 col-12  text-right">
					@if (Auth::check())
						<a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
					@else
						<a href="{{ route('login') }}" class="btn btn-success">Login to create new post</a>
					@endif
				</div> --}}
			</div>
			
			<div class="row">
				@if ($posts->count())
					<div class="col-lg-8 mb-3">
						@foreach ($posts as $post)
						<div class="card shadow">

							{{-- == Thumbnail == --}}
							@if ($post->thumbnail)
							<a href="{{ route('posts.show', $post->slug) }}">
								<img src="{{ $post->takeImage }}" class="card-img-top" style="height: 400px;object-fit:cover;">
								{{-- <img src="{{ asset($post->takeImage()) }}" class="card-img-top" style="height: 270px;object-fit:cover;"> --}}
								{{-- <img src="{{ asset('/storage/' . $post->thumbnail) }}" class="card-img-top" style="height: 270px;object-fit:cover;"> --}}
							</a>
							@else
							<a href="{{ route('posts.show', $post->slug) }}">
								<img src="{{ asset("/storage/images/posts/notfound.jpg") }}" class="card-img-top" style="height: 400px;object-fit:cover;">
							</a>
							@endif

							{{-- == Content == --}}
							<div class="card-body">

								<div class="mb-2">
									<a href="{{ route('categories.show', $post->category->slug) }}" class="text-secondary">
										<small>{{ $post->category->name }}</small>
									</a>

									-

									@foreach ($post->tags as $tag)
										<a href="{{ route('tags.show', $tag->slug) }}" class="text-info">
										<small>{{ $tag->name }}</small>
									</a>
									@endforeach
								</div>

								{{-- == Title == --}}
								<a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">
									<h5 class="card-title font-weight-bold text-dark">
										{{$post->title}}
									</h5>
								</a>

								{{-- == Desc == --}}
								<p class="card-text text-secondary">
									{{-- {{$post->body}} --}}
									{{Str::limit($post->body, 195)}}
									{{-- {{Str::limit($post->body, 100, '.')}} --}}
								</p>

								<div class="d-flex justify-content-between">
									<div class="text-secondary">
										<small>
											Published on {{$post->created_at->format("d F, Y")}}
										</small>
									</div>

									<p class="text-secondary m-0 font-italic">
										<small>
											Wrote By : {{$post->author->name}}
										</small>
									</p>

								</div>
								{{-- <a href="/posts/{{$post->slug}}">Read More</a> --}}
							</div>
							{{-- <div class="card-footer">
								<div class="d-flex flex-row align-self-center"> --}}
									{{-- Published on {{$post->created_at->diffForHumans()}} --}}
									
									{{-- <div class="col-auto align-self-center"> --}}
										{{-- @auth
											<a href="/posts/{{$post->slug}}/edit" class="btn btn-sm btn-info">Edit</a>
										@endauth --}}

										{{-- @if (auth()->user()->is($post->author))
											<a href="/posts/{{$post->slug}}/edit" class="btn btn-sm btn-info">Edit</a>
										@endif --}}
									{{-- </div> --}}

								{{-- </div>
							</div> --}}
						</div>
						@endforeach
					</div>
					<div class="col-12">
						{{$posts->links()}}
					</div>
				@else
					<div class="alert alert-info" role="alert">
						There are no posts
					</div>
				@endif


			
			</div>
		</div>
@endsection