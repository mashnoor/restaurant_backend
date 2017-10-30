@extends('admin.master')

@section('title', '| Edit Discount')

{{-- For Date Picker --}}
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
{{-- End Date Picker --}}

@section('content')
	<div class="row">		
		<div class="col-md-8 col-md-offset-2">
			<h1>Edit Discount</h1>
			<hr>
		{!! Form::model($discount, ['route' => ['discount.update', $discount->id], 'method' => 'PUT']) !!}
			<div class="form-group">
				{{ Form::label('type', 'Type :', ['class'=> 'control-label col-sm-2']) }}
				<div class="col-sm-10">
				    {{ Form::radio('type', 'invoice', ['class' => 'form-control']) }} Invoice 	
				    {{ Form::radio('type', 'menu', ['class' => 'form-control']) }} Menu  	
				</div>
			</div>
		
			<div class="form-group eg">
				{{ Form::label('menu_id', 'Menu ID :', ['class'=>'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::select('menu_id', $menus, null, ['class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('from_date', 'Form Date :', ['class' => 'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::text('from_date', null, ['class' => 'form-control datepicker']) }}
				</div>
			</div> 

			<div class="form-group">
				{{ Form::label('to_date', 'To Date :', ['class' => 'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::text('to_date', null, ['class' => 'form-control datepicker']) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('discount', 'Discount :', ['class' => 'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{Form::text('discount', null, ['class' => 'form-control'])}}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('active', 'Active :', ['class' => 'control-label col-sm-2']) }}
				<div class="col-sm-10">
					{{ Form::number('active', null, ['class' => 'form-control'])}}
				</div>
			</div>

			{!! Html::linkRoute('discount.show', 'Cancel', [$discount->id], ['class' => 'btn btn-danger pull-right', 'style' => 'margin-top: 18px;']) !!}
			{!! Form::submit('Save Changes', ['class' => 'btn btn-success pull-right', 'style' => 'margin-top: 18px;']) !!}

		{!! Form::close() !!}
		</div>	
		
	</div>
@stop