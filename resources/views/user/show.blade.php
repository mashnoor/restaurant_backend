@extends('admin.master')

@section('title', '| Show Users')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h2 class="text-center">User Details</h2>
			<div class="col-md-10 col-md-offset-1">
				<hr>
			</div>
			<table class="table table-striped">
				<tr>
					<th width="15%">ID</th>
					<td>{{ $user->id }}</td>
				</tr>

				<tr>
					<th width="15%">Name</th>
					<td>{{ $user->name }}</td>
				</tr>

				<tr>
					<th width="15%">User Name</th>
					<td>{{ $user->username }}</td>
				</tr>

				<tr>
					<th width="15%">User Type</th>
					<td>{{ $user->user_type }}</td>
				</tr>

			</table>
			<table class="table text-right">
				<tr>
					<td>
						<div class="col-md-11 text-right">
							{!! Html::linkRoute('user.edit', 'Edit', array($user->id), array('class' => 'btn btn-primary')) !!}
						</div>
						<div class="col-md-1  text-right">
							{!! Html::linkRoute('user.index', 'Cancel', [$user->id], ['class' => 'btn btn-danger pull-right']) !!}
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>

@endsection