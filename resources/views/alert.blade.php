@if (session()->has('success'))
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="alert alert-success" role="alert">
				{{ session()->get('success')}}
			</div>
		</div>
	</div>
</div>
@endif
@if (session()->has('error'))
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="alert alert-danger" role="alert">
				{{ session()->get('error')}}
			</div>
		</div>
	</div>
</div>
@endif
