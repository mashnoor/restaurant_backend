@extends('admin.master')

@section('title', '| All Table')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>All Table</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('table.create') }}" class="btn btn-primary btn-lg btn-block" style="
		    margin-top: 18px;">Create Table</a>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<hr>
		</div>
	</div> {{-- End of the row --}}

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-hover">
				<thead>
					<th>ID</th>
					<th>Code</th>
					<th>Capacity</th>
					<th>User Name</th>
					<th>Status</th>
					<th></th>
				</thead>
				<tbody>
				@foreach ($tables as $table)
					<tr>
						<th>{{ $table->id }}</th>
						<td>{{ $table->code }}</td>
						<td>{{ $table->capacity }}</td>
						<td>{{ $table->user->name }}</td>
						<td>{{ $table->status }}</td>
						<td>
							<a href="{{ route('table.show', $table->id) }}" class="btn btn-primary btn-sm">View</a>
							<a href="{{ route('table.edit', $table->id) }}" class="btn btn-primary btn-sm">Edit</a>

							{!! Form::open(['method' => 'DELETE', 'route' => ['table.destroy', $table->id], 'style' => 'display:inline']) !!}
								{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}

							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach					
				</tbody>
			</table>

			<div class="text-center">
				{!! $tables->links() !!}
				{{-- {!! $menus->render() !!} It's another method for pagination --}}
			</div>

		</div>
	</div>
@stop
