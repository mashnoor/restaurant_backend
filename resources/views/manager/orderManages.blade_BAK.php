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
          <th>Order Time</th>
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
            <td>{{ date('M j, y, g:i a', strtotime($orderManage->created_at)) }}</td>
            <td>
              @if ($orderManage->status == 1)
                Pending
              @elseif ($orderManage->status == 2)
                Process
              @elseif ($orderManage->status == 3)
                Serve
              @elseif ($orderManage->status == 4)
                Print Invoice
              @elseif ($orderManage->status == 5)
                Order Completed
              @endif
            </td>
            <td>              
              <a href="{{ route('order.showCash', $orderManage->id) }}" class="btn btn-primary btn-sm">View</a>
            </td>
            @if ($orderManage->status == 3)
              <td>
                {{-- <a target="_blank" href="{{ route('order.billSubmit', $orderManage->id) }}" onclick="window.location.reload(true)" class="btn btn-info btn-sm">Submit Bill</a> --}}

                <a  style="cursor: pointer;"  class="btn btn-info btn-sm PrintInvoice"  data-printinvoice="{{ $orderManage->id }}">Submit Bill</a>
              </td>
            @elseif ($orderManage->status == 4)
              <td>
                <a href="{{ route('order.cashReceived', $orderManage->id) }}" class="btn btn-info btn-sm">Cash Received</a>
              </td>
            @elseif ($orderManage->status >= 5)
              <td>
                <a href="{{ route('order.edit', $orderManage->id) }}" class="btn btn-success btn-sm">VOID</a>
              </td>
              
            @endif
          </tr>
        @endforeach         
        </tbody>
      </table>

      <div class="text-center">
        {{ $ordermanages->links() }}
      </div>

    </div>
  </div>

<script>
  $(document).ready(function() { 

    $(".PrintInvoice").click(function(){
    
      var id=$(this).data("printinvoice");  
      var token = '{{ csrf_token() }}';  
      $.ajax({    
        type:'POST',
        url:'{{ url()->route("order.billSubmit") }}',
        data:{id: id, _token:token},
        success:function(response){
          if(response.status == 1)
          {
            var redirect = window.open('{{ url()->route("order.printInvoice","") }}/'+response.id,'_blank');
            redirect.location;
            window.focus();
            window.location.href=window.location.href;
          }
          else
          {
            alert('Something went wrong!');
          }
        }
      });
    });

    // setTimeout(function(){
    // location.reload();

    // },5000);

  });
</script>

@stop

