@extends('admin.master')

@section('title', '| Create Discount')

@section('stylesheets')
	{!! Html::style('css/jquery-ui.css') !!}
@stop

@section('scripts')
	{!! Html::script('js/jquery-1.12.4.js') !!}
	{!! Html::script('js/jquery-ui.js') !!}

	<script type="text/javascript">
		$( function() {
		   $( ".datepicker" ).datepicker({
			  dateFormat: "yy-mm-dd"
			});
		});
	</script>
@stop

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-center">Create Discount</h1>
			<hr>
			{!! Form::open(['route' => 'discount.store', 'class' => 'form-horizontal' ]) !!}

				<div class="form-group">
					{{ Form::label('type', 'Type :', ['class'=> 'control-label col-sm-2']) }}
					<div class="col-sm-10">
					    {{ Form::radio('type', 'invoice', ['class' => 'form-control']) }} Invoice 	
					    {{ Form::radio('type', 'menu', ['class' => 'form-control']) }} Menu
					    <span class="small text-danger">{{ $errors->first('type') }}</span>	
					</div>
				</div>
			
				<div class="form-group">
					{{ Form::label('menu_id', 'Menu ID :', ['class'=>'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::select('menu_id', $discounts, null, ['class' => 'form-control']) }}
						<span class="small text-danger">{{ $errors->first('menu_id') }}</span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('from_date', 'Form Date :', ['class' => 'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::text('from_date', null, ['class' => 'form-control datepicker']) }}
						<span class="small text-danger">{{ $errors->first('from_date') }}</span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('to_date', 'To Date :', ['class' => 'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::text('to_date', null, ['class' => 'form-control datepicker']) }}
						<span class="small text-danger">{{ $errors->first('to_date') }}</span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('discount', 'Discount :', ['class' => 'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{Form::text('discount', null, ['class' => 'form-control'])}}
						<span class="small text-danger">{{ $errors->first('discount') }}</span>
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('active', 'Active :', ['class' => 'control-label col-sm-2']) }}
					<div class="col-sm-10">
						{{ Form::number('active', null, ['class' => 'form-control'])}}
						<span class="small text-danger">{{ $errors->first('active') }}</span>
					</div>
				</div>

				{{ Form::submit('Create Discount', ['class' => 'btn btn-success btn-lg btn-discount']) }}

			{!! Form::close() !!}
		</div>
	</div>
@stop

