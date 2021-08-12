@extends('layouts.app', ['title' => 'New Post'])

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">New Post</div>
				<div class="card-body">
					<form action="/posts/store" method="POST">
						@csrf
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title">
							@error('title')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="body">Body</label>
							<textarea name="body" class="form-control @error('body') is-invalid @enderror" id="body" rows="3"></textarea>
							@error('body')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						
						<button type="submit" class="btn btn-primary">Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
		
@endsection