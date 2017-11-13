@extends('admin.master')

@section('title', '| Show Categories')

@section('content')
	<div class="row">
	{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT']) !!}
		<div class="col-md-8 col-md-offset-1">
			<h1 class="text-center">Edit User</h1>
			<hr>
			<div class="form-group">
				{{ Form::label('name', 'Full Name:', ['class'=>'control-label col-sm-2']) }}
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

			{!! Html::linkRoute('user.show', 'Cancel', [$user->id], ['class' => 'btn btn-danger pull-right']) !!}
			{!! Form::submit('Saves Changes', ['class' => 'btn btn-success pull-right']) !!}
			
		</div>
	{!! Form::close() !!}
	</div>

@stop