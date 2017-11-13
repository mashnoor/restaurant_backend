@extends('admin.master')

@section('title', '| All Orders')

@section('content')

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h1 class="text-center">All Pantry Orders</h1>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-hover">
				<thead>
					<th>Order ID</th>
					<th>Table Code</th>
					<th>Sub Total</th>
					<th>Discount</th>
					<th>VAT</th>
					<th>Total Discount</th>
					<th>Net Total</th>
					<th>Order Time</th>
					<th>Status</th>
					<th>View</th>
					{{-- <th>Process</th>
					<th>Serve</th> --}}
				</thead>
				<tbody>
				@foreach ($pantrys as $pantry)
					<tr>
						<th>{{ $pantry->id }}</th>
						<td>{{ $pantry->table->code }}</td>
						<td>{{ $pantry->sub_total }}</td>
						<td>{{ $pantry->discount }}</td>
						<td>{{ $pantry->vat }}</td>
						<td>{{ $pantry->rounding_discount }}</td>
						<td>{{ $pantry->net_total }}</td>
						<td>{{ date('M j, y, g:i a', strtotime($pantry->created_at)) }}</td>
						<td>
							@if ($pantry->status == 1)
								Pending
							@elseif ($pantry->status == 2)
								Process
							@elseif ($pantry->status == 3)
								Serve
							@elseif ($pantry->status == 4)
								Cash Received
							@elseif ($pantry->status == 5)
								Order Complete
							{{-- @elseif ($order->status == 6)
								Order Complete --}}
							@endif
						</td>
						<td>							
							<a href="{{ route('pantry.show', $pantry->id) }}" class="btn btn-primary btn-sm">View</a>
						</td>
						{{-- @if ($pantry->status == 2)
							<td>------</td>
							<td>
								<a href="{{ route('order.serve', $pantry->id) }}" class="btn btn-success btn-sm">Serve</a>
							</td>
						@elseif ($pantry->status == 1)
							<td>							
								<a href="{{ route('order.process', $pantry->id) }}" class="btn btn-info btn-sm">Process</a>
							</td>
							<td>------</td>
						@elseif ($pantry->status == 3 || 4)
							<td>------</td>
							<td>------</td>
						@endif --}}
					</tr>
				@endforeach					
				</tbody>
			</table>

			<div class="text-center">
				{{ $pantrys->links() }}
			</div>

		</div>
	</div>

@stop
