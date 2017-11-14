@extends('admin.master')

@section('title', '| All Users')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>All Users</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('user.create') }}" class="btn btn-primary btn-lg btn-block" style="
		    margin-top: 18px;">Create New User</a>
		</div>
		<div class="col-md-10 col-md-offset-1"><hr></div>
	</div> {{-- End of the row --}}

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-hover">
				<thead>
					<th>ID</th>
					<th>Full Name</th>
					<th>User Name</th>
					<th>User Type</th>
					<th>View</th>
					<th>Edit</th>
					<th>Delete</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<th>{{ $user->id }}</th>
							<td>{{ $user->name }}</td>
							<td>{{ $user->username }}</td>
							<td>{{ $user->user_type }}</td>
							<td>
								<a href="{{ route('user.show', $user->id ) }}" class="btn btn-info">View</a>
							</td>
							<td>	
								<a href="{{ route('user.edit', $user->id ) }}" class="btn btn-primary">Edit</a>
							</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id], 'onsubmit' => 'return confirm("Are you sure you want to delete?")', 'style' => 'display:inline']) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $users->links() !!}
			</div>
		</div>
	</div>

{{-- <script>
	$(document).ready(function() {
		function confirm()
	  {
	  var x = confirm("Are you sure you want to delete?");
	  if (x)
	    return true;
	  else
	    return false;
	  }
   
	});
</script> --}}

@stop