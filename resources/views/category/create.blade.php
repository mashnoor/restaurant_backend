@extends('admin.master')

@section('title', '| Create Category')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-center">Create New Category</h1>
			<hr>
			{!! Form::open(['route' => 'category.store', 'class'=> 'form-horizontal']) !!}

				<div class="form-group">
					{{ Form::label('name', 'Name:', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::text('name', null, ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('name') }}</span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('image', 'Images:', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::file('image', null, ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('image') }}</span>
					</div>
				</div>

				{{ Form::submit('Create Menu', ['class' => 'btn btn-success btn-lg pull-right']) }}

			{!! Form::close() !!}
		</div>
	</div>

@stop