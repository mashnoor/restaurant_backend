@extends('admin.master')

@section('title', '| Show Categories')

@section('content')
	<div class="row">
	{!! Form::model($category, ['route' => ['category.update', $category->id], 'method' => 'PUT', 'files' => true]) !!}
		<div class="col-md-8 col-md-offset-1">
			<h1 class="text-center">Edit Category</h1>
			<hr>
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

			{!! Html::linkRoute('category.show', 'Cancel', [$category->id], ['class' => 'btn btn-danger pull-right']) !!}
			{!! Form::submit('Saves Changes', ['class' => 'btn btn-success pull-right']) !!}
			
		</div>
	{!! Form::close() !!}
	</div>

@stop