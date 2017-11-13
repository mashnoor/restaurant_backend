@extends('admin.master')

@section('title', '| Create New User')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-center">Create New User</h1>
			<hr>
			{!! Form::open(['route' => 'user.store', 'class'=> 'form-horizontal']) !!}

				<div class="form-group">
					{{ Form::label('name', 'Full Name :', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::text('name', null, ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('name') }}</span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('username', 'User Name :', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::text('username', null, ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('username') }}</span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('user_type', 'User Type :', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::select('user_type', App\Helper::getUserTypes(), null, ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('user_type') }}</span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('password', 'Password :', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::password('password', ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('password') }}</span>
					</div>
				</div>

				{{ Form::submit('Create Category', ['class' => 'btn btn-success btn-lg pull-right']) }}

			{!! Form::close() !!}
		</div>
	</div>

@stop