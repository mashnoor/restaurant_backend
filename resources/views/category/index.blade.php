@extends('admin.master')

@section('title', '| All Category')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>All Category</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('category.create') }}" class="btn btn-primary btn-lg btn-block" style="
		    margin-top: 18px;">Create Category</a>
		</div>
		<div class="col-md-10 col-md-offset-1"><hr></div>
	</div> {{-- End of the row --}}

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-hover">
				<thead>
					<th>ID</th>
					<th>Name</th>
					<th>Image</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($categores as $category)
						<tr>
							<th>{{ $category->id }}</th>
							<td>{{ $category->name }}</td>
							<td>{{ $category->image }}</td>
							<td>
								<a href="{{ route('category.show', $category->id ) }}" class="btn btn-primary btn-sm">View</a>
								<a href="{{ route('category.edit', $category->id ) }}" class="btn btn-primary btn-sm">Edit</a>
								{!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id], 'style' => 'display:inline']) !!}
								{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}

								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $categores->links() !!}
			</div>
		</div>
	</div>

@stop