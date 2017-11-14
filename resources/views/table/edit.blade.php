@extends('admin.master')

@section('title', '| Edit Menus')

@section('content')
	<div class="row">
	{!! Form::model($table, ['route' => ['table.update', $table->id], 'method' => 'PUT']) !!}
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-center">Edit Table</h1>
			<hr>
		
			<div class="form-group">
				{{ Form::label('code', 'Items Code:', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::text('code', null, ['class' => 'form-control']) }}
					<span class="small text-danger">{{ $errors->first('code') }}</span>
				</div>
			</div>
		    
			<div class="form-group">
				{{ Form::label('capacity', 'Name:', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::text('capacity', null, ['class' => 'form-control']) }}
					<span class="small text-danger">{{ $errors->first('capacity') }}</span>
				</div>
			</div>

			{{-- <div class="form-group">
				{{ Form::label('user_id', 'Select User :', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::select('user_id', $users, null, ['class' => 'form-control']) }}
					<span class="small text-danger">{{ $errors->first('user_id') }}</span>
				</div>
			</div> --}}

			{!! Html::linkRoute('table.show', 'Cancel', [$table->id], ['class' => 'btn btn-danger pull-right']) !!}
			{!! Form::submit('Saves Changes', ['class' => 'btn btn-success pull-right']) !!}

		</div>
	{!! Form::close() !!}
	</div>
@stop