@extends('admin.master')

@section('title', '| Available Menu')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h1 class="text-center">All Available Menus</h1>
    </div>
    <div class="col-md-10 col-md-offset-1">
      <hr>
    </div>
  </div> {{-- End of the row --}}

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <table class="table table-hover">
        <thead>
          <th>ID</th>
          <th>Code</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Image</th>
          <th>Available/Unavailable</th>
          <th>Available/Unavailable</th>
        </thead>
        <tbody>
        @foreach ($availables as $menu)
          <tr>
            <th>{{ $menu->id }}</th>
            <td>{{ $menu->code }}</td>
            <td>{{ $menu->name }}</td>
            <td>{{ substr($menu->description, 0, 20) }}{{ strlen($menu->description) > 20 ? "..." : "" }}</td>
            <td>{{ $menu->price }}</td>
            <td>{{ $menu->image }}</td>
            <td>
              @if ($menu->available == 1)
                <strong style="color: green;">Available</strong> 
              @elseif ($menu->available == 0)
                <strong style="color: red;">Unavailable</strong>
              @endif 
            </td>
            @if ($menu->available == 1) 
            <td>
              <a href="{{ route('order.availables', $menu->id) }}" class="btn btn-danger">Unavailable</a>
            </td>
            @elseif ($menu->available == 0)
            <td>
              <a href="{{ route('order.unavailable', $menu->id) }}" class="btn btn-primary">Available</a>
            </td>
            @endif
          </tr>
        @endforeach         
        </tbody>
      </table>

      <div class="text-center">
        {!! $availables->links() !!}
        {{-- {!! $menus->render() !!} It's another method for pagination --}}
      </div>

    </div>
  </div>
@stop
