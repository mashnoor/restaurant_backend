@extends('admin.master')

@section('title', '| All Menu')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>All Menus</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('menu.create') }}" class="btn btn-primary btn-lg btn-block" style="
		    margin-top: 18px;">Create Menu</a>
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
					<th>Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>View</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody>
				@foreach ($menus as $menu)
					<tr>
						<th>{{ $menu->id }}</th>
						<td>{{ $menu->code }}</td>
						<td>{{ $menu->name }}</td>
						<td>{{ substr($menu->description, 0, 20) }}{{ strlen($menu->description) > 20 ? "..." : "" }}</td>
						<td>{{ $menu->price }}</td>
						<td>{{ $menu->image }}</td>
						<td>
							<a href="{{ route('menu.show', $menu->id) }}" class="btn btn-primary">View</a>
						</td>
						<td>
							<a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-info">Edit</a>
						</td>
						<td>
							{!! Form::open(['method' => 'DELETE', 'route' => ['menu.destroy', $menu->id], 'style' => 'display:inline']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach					
				</tbody>
			</table>

			<div class="text-center">
				{!! $menus->links() !!}
				{{-- {!! $menus->render() !!} It's another method for pagination --}}
			</div>

		</div>
	</div>
@stop
