@extends('admin.master')

@section('title', '| Create New Menu')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-center">Create New Menu</h1>
			<hr>
			{!! Form::open(['route' => 'menu.store', 'class'=> 'form-horizontal', 'files'=>true]) !!}
				
				<div class="form-group">
					{{ Form::label('category_id', 'Category:', ['class'=> 'control-label col-sm-2']) }}
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
				
				{{-- {{ Form::label('available', 'Available:')}}
			    {{ Form::text('available', null, array('class' => 'form-control')) }} --}}

			    {{ Form::submit('Create Menu', ['class' => 'btn btn-success btn-lg pull-right']) }}

			{!! Form::close() !!}
		</div>
	</div>

@stop