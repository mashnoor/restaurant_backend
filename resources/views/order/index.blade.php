@extends('admin.master')

@section('title', '| All Orders')

@section('content')

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h1 class="text-center">All Orders</h1>
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
					<th>Process</th>
					<th>Serve</th>
				</thead>
				<tbody>
				@foreach ($orders as $order)
					<tr>
						<th>{{ $order->id }}</th>
						<td>{{ $order->table->code }}</td>
						<td>{{ $order->sub_total }}</td>
						<td>{{ $order->discount }}</td>
						<td>{{ $order->vat }}</td>
						<td>{{ $order->rounding_discount }}</td>
						<td>{{ $order->net_total }}</td>
						<td>{{ date('M j, y, g:i a', strtotime($order->created_at)) }}</td>
						<td>
							@if ($order->status == 1)
								Pending
							@elseif ($order->status == 2)
								Process
							@elseif ($order->status == 3)
								Serve
							@elseif ($order->status == 4)
								Cash Received
							@elseif ($order->status == 5)
								Order Complete
							{{-- @elseif ($order->status == 6)
								Order Complete --}}
							@endif
						</td>
						<td>							
							<a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
						</td>
						@if ($order->status == 2)
							<td>------</td>
							<td>
								<a href="{{ route('order.serve', $order->id) }}" class="btn btn-success btn-sm">Serve</a>
							</td>
						@elseif ($order->status == 1)
							<td>							
								<a href="{{ route('order.process', $order->id) }}" class="btn btn-info btn-sm">Process</a>
							</td>
							<td>------</td>
						@elseif ($order->status == 3 || 4)
							<td>------</td>
							<td>------</td>
						@endif
					</tr>
				@endforeach					
				</tbody>
			</table>

			<div class="text-center">
				{{ $orders->links() }}
			</div>

		</div>
	</div>

<script type="text/javascript">

	setTimeout(function(){
	  location.reload();

	},5000);

</script>

@stop
