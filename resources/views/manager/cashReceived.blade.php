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
          <tr>

            {{ Form::open(['method' => 'post', 'route' => ['order.getPaymentModes', $orderManages->id]]) }}
            <td>
              <div class="form-group">
                {{ Form::label('cash_received', 'Discount Cash:', ['class'=> 'control-label']) }}
                <div class="col-sm-10">
                  {{ Form::number('cash_received', null, ['class' => 'form-control cash']) }}
                  {{ Form::hidden('id', $orderManages->id) }}
                  {{ Form::hidden('nettotal', $grandTotal) }}
                </div>
              </div>
            </td>
            <td>
              <div class="form-group">
                {{ Form::label('payment_modes', 'Payment Mode:', ['class'=> 'control-label col-sm-2']) }}
                <div class="col-sm-10">
                    {{ Form::select('payment_modes', App\Helper::getPaymentModes(), null, ['class' => 'form-control']) }}  
                </div>
              </div>
            </td>
            <tr>
              <td>{{ Form::submit('Cash Receive', ['class' => 'btn btn-success pull-right']) }}</td>
            </tr>
            
            {{ Form::close() }}
          </tr>
        </tbody>
      </table>

    </div>
  </div>

@stop