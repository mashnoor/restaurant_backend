<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Order;

class OrderController extends Controller
{

  public function index()
  {
    $orders = Order::orderBy('id', 'desc')->paginate(10);

    return view('order.index')->withOrders($orders);
  }


  public function show($id)
  {
    $order = Order::find($id);
    return view('order.show')->withOrder($order);
  }


  public function orderServe($id)
  {
    $order = Order::find($id);
    $order->status = 3;

    $order->save();

    Session::flash('success', 'The Order was successfully Serve!');

    return redirect()->back();
  }


  public function orderProcess($id)
  {
    $order = Order::find($id);
    $order->status = 2;

    $order->save();

    Session::flash('success', 'The Order was successfully Process!');

    return redirect()->back();
  }


}
