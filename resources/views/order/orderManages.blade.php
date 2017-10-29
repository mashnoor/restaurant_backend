@extends('admin.master')

@section('title', '| Manage All Orders')

@section('content')

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h1 class="text-center">Manage All Orders</h1>
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
          <th>Status</th>
          <th>View</th>
          <th>Cash Received</th>
        </thead>
        <tbody>
        @foreach ($ordermanages as $orderManage)
          <tr>
            <th>{{ $orderManage->id }}</th>
            <td>{{ $orderManage->table->code }}</td>
            <td>{{ $orderManage->sub_total }}</td>
            <td>{{ $orderManage->discount }}</td>
            <td>{{ $orderManage->vat }}</td>
            <td>{{ $orderManage->rounding_discount }}</td>
            <td>{{ $orderManage->net_total }}</td>
            <td>
              @if ($orderManage->status == 1)
                Pending
              @elseif ($orderManage->status == 2)
                Process
              @elseif ($orderManage->status == 3)
                Serve
              @elseif ($orderManage->status == 4)
                Cash Received
              @elseif ($orderManage->status == 5)
                Order Complete
              {{-- @elseif ($orderManage->status == 6)
                Order Complete --}}
              @endif
            </td>
            <td>              
              <a href="{{ route('order.showCash', $orderManage->id) }}" class="btn btn-primary btn-sm">View</a>
            </td>
            @if ($orderManage->status == 3)
              <td>
                <a href="{{ route('order.cashReceivd', $orderManage->id) }}" class="btn btn-success btn-sm">Cash Received</a>
              </td>
            @elseif ($orderManage->status == 4)
              <td>
                <a target="_blank" href="{{ route('order.invoicePrint', $orderManage->id) }}" class="btn btn-info btn-sm">Print Invoice</a>
              </td>
            @elseif ($orderManage->status == 5)
              <td>
                <a target="_blank" href="{{ route('order.invoicePrint', $orderManage->id) }}" class="btn btn-info btn-sm">Print Invoice</a>
              </td>
              {{-- <td>
                <a href="{{ route('order.orderComplete', $orderManage->id) }}" class="btn btn-info btn-sm">Complete</a>
              </td> --}}
            {{-- @elseif ($orderManage->status == 6)
              <td>Complet</td> --}}
            @endif
          </tr>
        @endforeach         
        </tbody>
      </table>

      <div class="text-center">
        {{-- {{ $ordermanages->links() }} --}}
      </div>

    </div>
  </div>

@stop
