@extends('admin.master')

@section('title', '| Show Table')

@section('content')
	<div class="row">
		<div class="col-md-12">
			
			<table class="table table-striped">
				<tr>
					<th width="15%">ID</th>
					<td>{{ $table->id }}</td>
				</tr>
				<tr>
					<th width="15%">Code</th>
					<td>{{ $table->code }}</td>
				</tr>
				<tr>
					<th width="15%">Capacity</th>
					<td>{{ $table->capacity }}</td>
				</tr>
				
			</table>

			<table class="table text-right">
				<tr>
					<td>
						<div class="col-md-11 text-right">
							{!! Html::linkRoute('table.edit', 'Edit', array($table->id), array('class' => 'btn btn-primary')) !!}
						</div>
						<div class="col-md-1  text-right">
							{!! Form::open(['route' => ['table.destroy', $table->id], 'method' => 'DELETE']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

							{!! Form::close() !!}
						</div>
					</td>
				</tr>
			</table>
				
		</div>
	</div>
@stop