@extends('admin.master')

@section('title', '| Show Menu')

@section('content')
	<div class="row">
		<div class="col-md-12">
			
			<table class="table table-striped">
				<tr>
					<th width="15%">ID</th>
					<td>{{ $menu->id }}</td>
				</tr>
				<tr>
					<th width="15%">Code</th>
					<td>{{ $menu->code }}</td>
				</tr>
				<tr>
					<th width="15%">Name</th>
					<td>{{ $menu->name }}</td>
				</tr>
				<tr>
					<th width="15%">Description</th>
					<td>{{ $menu->description }}</td>
				</tr>
				<tr>
					<th width="15%">Price</th>
					<td>{{ $menu->price }}</td>
				</tr>
				<tr>
					<th width="15%">Image</th>
					<td>{{ $menu->image }}</td>
				</tr>
				
			</table>

			<table class="table text-right">
				<tr>
					<td>
						<div class="col-md-11 text-right">
							{!! Html::linkRoute('menu.edit', 'Edit', array($menu->id), array('class' => 'btn btn-primary')) !!}
						</div>
						<div class="col-md-1  text-right">
							{!! Form::open(['route' => ['menu.destroy', $menu->id], 'method' => 'DELETE']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

							{!! Form::close() !!}
						</div>

					</td>
				</tr>
			</table>
				
		</div>
	</div>
@stop