@extends('admin.master')

@section('title', '| Daily Reports')

@section('stylesheets')
  {!! Html::style('css/jquery-ui.css') !!}
@stop

@section('scripts')
  {!! Html::script('js/jquery-1.12.4.js') !!}
  {!! Html::script('js/jquery-ui.js') !!}

  <script type="text/javascript">
    $( function() {
      $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
    });
  </script>
@stop

@section('content')

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h1 class="text-center">Daily Reports</h1>
    </div>
    <div class="col-md-10 col-md-offset-1">
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      {!! Form::open(['route' => 'report.search', 'class'=> 'form-horizontal']) !!}
    
      <div class="col-md-4">
        <div class="form-group">
          {{ Form::label('from_date', 'Form Date:', ['class' => 'control-label col-sm-4']) }}
          <div class="col-sm-8">
            {{ Form::text('from_date', null, ['class' => 'form-control datepicker']) }}
            <span class="small text-danger">{{ $errors->first('from_date') }}</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          {{ Form::label('to_date', 'To Date :', ['class' => 'control-label col-sm-4']) }}
          <div class="col-sm-8">
            {{ Form::text('to_date', null, ['class' => 'form-control datepicker']) }}
            <span class="small text-danger">{{ $errors->first('to_date') }}</span>
          </div>
        </div>
      </div>
      {{ Form::submit('Search', ['class' => 'btn btn-default']) }}
    </div>
  </div>
  <div class="col-md-10 col-md-offset-1">
    <hr>
  </div>

  {!! Form::close() !!}

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <table class="table table-hover">
        <thead>
          <th>Order ID</th>
          <th>Table Code</th>
          <th>Payment Mode</th>
          <th>Sub Total</th>
          <th>VAT</th>
          <th>Total Discount</th>
          <th>Net Total</th>
          <th>Date</th>
        </thead>
        <tbody>
        @foreach ($reports as $report)
          <tr>
            <th>{{ $report->id }}</th>
            <td>{{ $report->table->code }}</td>
            <td>{{ App\Helper::getPaymentModes()[$report->payment_modes] }}</td>
            <td>{{ $report->sub_total }}</td>
            <td>{{ $report->vat }}</td>
            <td>{{ $report->rounding_discount }}</td>
            <td>{{ $report->cash_received }}</td>
            <td>{{ date('M j, y, g:i a', strtotime($report->created_at)) }}</td>
          </tr>

        @endforeach
        <tr>
          <td colspan="4">&nbsp;</td>
          <td>
            <a href="{{ route('store.report') }}" class="btn btn-danger">Delete Reports</a>
          </td>
          <td>
          {!! Form::open(['method' => 'post', 'route' => ['categorywise.reports'], 'style' => 'display:inline']) !!} 
            
            {!! Form::submit('Category Reports', ['class' => 'btn btn-primary']) !!}

          {!! Form::close() !!}
          </td>
          <td>
            {!! Form::open(['method' => 'post', 'route' => ['download.reports'], 'style' => 'display:inline']) !!}

              {!! Form::submit('Download Reports', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
          </td>
          </tr>      
        </tbody>
      </table>

      <div class="text-center">
        {{ $reports->links() }}
      </div>

    </div>
  </div>

@stop

