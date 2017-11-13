@extends('admin.master')

@section('title', '| Show Orders')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h1 class="text-center">Pantry Order Details</h1>
			<div class="col-md-10 col-md-offset-1">
				<hr>
			</div>
			<table class="table table-hover">
				<thead>
					<th>Menu Name</th>
					<th>Order ID</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Discount</th>
					<th>Total</th>
				</thead>
				<tbody>
					@foreach ($order->menus as $menu)
						<tr>
							<td>{{ $menu->name }}</td>
							<td>{{ $order->id	}}</td>
							<td>{{ $menu->pivot->quantity }}</td>
							<td>{{ $menu->pivot->price }}</td>
							<td>{{ $menu->pivot->discount }}</td>
							<td>{{ $menu->pivot->total }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<table class="table text-right">
				<tr>
					<td>
						<a href="{{ URL::to('/pantry') }}" class="btn btn-primary btn-lg">Back</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
@stop