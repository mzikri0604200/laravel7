@extends('layouts.app')

@section('content')
		<div class="container">
			<div class="row mb-4">
				<div class="col-6">
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
				<div class="col-6 text-right">
					<a href="/posts/create" class="btn btn-primary">Create Post</a>
				</div>
			</div>
			<div class="row">

				@if ($posts->count())

					@foreach ($posts as $post)
						<div class="col-lg-4 mb-3">
							<div class="card">
								<div class="card-header">
									{{$post->title}}
								</div>
								<div class="card-body">
									<p>
										{{-- {{$post->body}} --}}
										{{Str::limit($post->body, 100)}}
										{{-- {{Str::limit($post->body, 100, '.')}} --}}
									</p>
									<a href="/posts/{{$post->slug}}">Read More</a>
								</div>
								<div class="card-footer">
									<div class="d-flex flex-row justify-content-between align-self-center">
										{{-- Published on {{$post->created_at->diffForHumans()}} --}}
										<div class="col-auto align-self-center">
											Published on {{$post->created_at->format("d F, Y")}}
										</div>
										<div class="col-auto align-self-center">
											<a href="/posts/{{$post->slug}}/edit" class="btn btn-sm btn-info">Edit</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach

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