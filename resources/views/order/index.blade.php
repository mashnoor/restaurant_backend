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
							@elseif ($order->status == 6)
								Order Complete(Void)
							@endif
						</td>
						<td>							
							<a target="_blank" href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
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

	@if($sound == 'play')
		<div style="display:none;">
			<audio controls autoplay>
			  <source src="audio/nf.mp3" type="audio/mpeg" autoplay>
					Your browser does not support the audio element.
			</audio>
		</div>
	@endif
<script type="text/javascript">

	setTimeout(function(){
	  location.reload();

	},60000);

</script>

@stop
