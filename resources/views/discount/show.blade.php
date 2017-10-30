@extends('admin.master')

@section('title', '| Show Discount')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table">
				<tr>
					<th width="15%">Type :</th>
					<td>{{ $discount->type }}</td>
				</tr>
				<tr>
					<th width="15%">Menu ID :</th>
					<td>{{ $discount->menu_id }}</td>
				</tr>
				<tr>
					<th width="15%">From Date :</th>
					<td>{{ date('M j, Y', strtotime($discount->from_date)) }}</td>
				</tr>
				<tr>
					<th width="15%">To Date :</th>
					<td>{{ date('M j, y', strtotime($discount->to_date)) }}</td>
				</tr>
				<tr>
					<th width="15%">Discount :</th>
					<td>{{ $discount->discount }}</td>
				</tr>
				<tr>
					<th width="15%">Active :</th>
					<td>{{ $discount->active }}</td>
				</tr>

			</table>
			<table class="table text-right">
				<tr>
					<td>
						<div class="col-md-11 text-right">
							{!! Html::linkRoute('discount.edit', 'Edit', [$discount->id], ['class' => 'btn btn-primary']) !!}
						</div>
						<div class="col-md-1  text-right">
							{!! Form::open(['route' => ['discount.destroy', $discount->id], 'method' => 'DELETE']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

							{!! Form::close() !!}
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>

@stop