@extends('admin.master')

@section('title', '| All Discount')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>All Discount</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('discount.create') }}" class="btn btn-primary btn-lg btn-block" style="margin-top: 18px;">Create Discount</a>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<hr>
		</div>
	</div> {{-- End of the Row --}}

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-striped">
				<thead>
					<th>ID :</th>
					<th>Type :</th>
					<th>Menu ID:</th>
					<th>From Date :</th>
					<th>To Date :</th>
					<th>Discount :</th>
					<th>Active :</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($discounts as $discount)
						<tr>
							<th>{{ $discount->id}}</th>
							<td>{{ $discount->type }}</td>
							<td>{{ $discount->menu_id }}</td>
							<td>{{ date('M j, Y', strtotime($discount->from_date)) }}</td>
							<td>{{ date('M j, y', strtotime($discount->to_date)) }}</td>
							<td>{{ $discount->discount }}</td>
							<td>{{ $discount->active }}</td>
							<td>
								<a href="{{ route('discount.show', $discount->id) }}" class="btn btn-primary btn-sm">View</a>
								<a href="{{ route('discount.edit', $discount->id) }}" class="btn btn-primary btn-sm">Edit</a>
								
								{!! Form::open(['method' => 'DELETE', 'route' => ['discount.destroy', $discount->id], 'style' => 'display:inline']) !!}
								{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}

								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@stop