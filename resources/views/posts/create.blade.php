@extends('layouts.app', ['title' => 'New Post'])

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">New Post</div>
				<div class="card-body">
					<form action="/posts/store" method="POST" autocomplete="off" enctype="multipart/form-data">
						@csrf
						@include('posts.partials.form-control', ['submit' => 'Create'])
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
		
@endsection