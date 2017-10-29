@if (Session::has('success'))
	<div class="alert alert-success" role="alert">
		<strong>Succss:</strong> {{ Session::get('success') }}
	</div>
@endif