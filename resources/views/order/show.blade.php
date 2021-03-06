@extends('admin.master')

@section('title', '| Show Orders')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h1 class="text-center">Order Details</h1>
			<div class="col-md-10 col-md-offset-1">
				<p style="text-align: right;"><strong>Waiter Name: {{ $order->waiterName->name }}</strong></p>
				<p style="text-align: right;"><strong>Table Name: {{ $order->table->code }}</strong></p>
				<p style="text-align: right;"><strong>Order Number: {{ $order->id }}</strong></p>
				<hr>
			</div>
			<table class="table table-hover">
				<thead>
					<th>Menu Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total</th>
				</thead>
				<tbody>
					@foreach ($order->menus as $menu)
						<tr>
							<td style="font-size: 30px;">{{ $menu->name }}</td>
							<td style="font-size: 30px;">{{ $menu->pivot->quantity }}</td>
							<td style="font-size: 30px;">{{ $menu->pivot->price }}</td>
							<td style="font-size: 30px;">{{ $menu->pivot->total }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<table class="table text-right">
				<tr>
					<td>
						<a href="{{ URL::to('/order') }}" class="btn btn-primary btn-lg">Back</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
@stop