@extends('admin.master')

@section('title', '| Create Table')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-center">Create Table</h1>
			<hr>
			{!! Form::open(['route' => 'table.store', 'class'=> 'form-horizontal']) !!}
			
				<div class="form-group">
					{{ Form::label('code', 'Items Code :', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::text('code', null, ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('code') }}</span>
					</div>
				</div>
			    
				<div class="form-group">
					{{ Form::label('capacity', 'Capacity :', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::text('capacity', null, ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('capacity') }}</span>
					</div>
				</div>

		    {{ Form::submit('Create Table', ['class' => 'btn btn-success btn-lg pull-right']) }}

			{!! Form::close() !!}

		</div>
	</div>

@stop