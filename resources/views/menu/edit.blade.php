@extends('admin.master')

@section('title', '| Edit Menus')

@section('content')
	<div class="row">
	{!! Form::model($menu, ['route' => ['menu.update', $menu->id], 'method' => 'PUT']) !!}
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-center">Edit Menu</h1>
			<hr>
			<div class="form-group">
				{{ Form::label('category_id', 'Category:', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
				    {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
				    <span class="small text-danger">{{ $errors->first('category_id') }}</span>	
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label('code', 'Items Code:', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::text('code', null, ['class' => 'form-control']) }}
					<span class="small text-danger">{{ $errors->first('code') }}</span>
				</div>
			</div>
		    
			<div class="form-group">
				{{ Form::label('name', 'Name:', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::text('name', null, ['class' => 'form-control']) }}
					<span class="small text-danger">{{ $errors->first('name') }}</span>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('description', 'Description:', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::textarea('description', null, ['class' => 'form-control']) }}
					<span class="small text-danger">{{ $errors->first('description') }}</span>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('price', 'Price:', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::text('price', null, ['class' => 'form-control']) }}
					<span class="small text-danger">{{ $errors->first('price') }}</span>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('image', 'Images:', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::file('image', null, ['class' => 'form-control']) }}
					<span class="small text-danger">{{ $errors->first('image') }}</span>
				</div>
			</div>

			{!! Html::linkRoute('menu.show', 'Cancel', [$menu->id], ['class' => 'btn btn-danger pull-right']) !!}
			{!! Form::submit('Saves Changes', ['class' => 'btn btn-success pull-right']) !!}

		</div>
	{!! Form::close() !!}
	</div>
@stop