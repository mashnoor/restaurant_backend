@extends('admin.master')

@section('title', '| Cash Receive')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h1 class="text-center">Order Details</h1>
      <div class="col-md-10 col-md-offset-1">
        <table width="100%">
          <tr>
            <td colspan="2" width="50%">&nbsp;</td>
            <td width="10%"><h4>Invoice ID : {{ $orderManages->id }}</h4></td>
          </tr>
        </table>
        <hr>
      </div>
      <table class="table table-hover">
        <thead>
          <th>Menu Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Discount</th>
          <th>Total</th>
        </thead>
        <tbody>
          <?php $grandTotal = 0; ?>
          @foreach ($orderManages->menus as $menu)
            <tr>
              <td>{{ $menu->name }}</td>
              <td>{{ $menu->pivot->quantity }}</td>
              <td>{{ $menu->pivot->price }}</td>
              <td>{{ $menu->pivot->discount }}</td>
              <td>{{ $menu->pivot->total }}</td>
              <?php $grandTotal += $menu->pivot->total; ?>
            </tr>
          @endforeach
          <tr>
            <td colspan="4" width="80%">Total Amount</td>
            <td width="20%">{{ $grandTotal }}</td>
          </tr>
        </tbody>
      </table>
      <table width="100%" class="table table-hover">
        <tbody>
          <tr>
            {{ Form::open(['method' => 'post', 'route' => ['order.getPaymentModes', $orderManages->id]]) }}
            <td width="15%" style="vertical-align: middle;">
              {{ Form::label('cash_received', 'Discount Cash:', ['class'=> 'control-label']) }}
            </td>
            <td width="35%" style="vertical-align: middle;">
              {{ Form::number('cash_received', null, ['class' => 'form-control cash']) }}
              {{ Form::hidden('id', $orderManages->id) }}
              {{ Form::hidden('nettotal', $grandTotal) }}</td>
            <td width="15%" style="vertical-align: middle;">
              {{ Form::label('payment_modes', 'Payment Mode:', ['class'=> 'control-label']) }}
            </td>
            <td width="35%" style="vertical-align: middle;">
              {{ Form::select('payment_modes', App\Helper::getPaymentModes(), null, ['class' => 'form-control']) }}
            </td>
          </tr>
          <tr>
            <td colspan="4" style="text-align: center; padding-top: 40px;">
              {{ Form::submit('Cash Receive', ['class' => 'btn btn-success']) }}
            </td>
          </tr>
          {{ Form::close() }}
        </tbody>
      </table>
    </div>
  </div>

@stop