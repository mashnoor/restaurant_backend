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
    $orders = Order::where('status', '>=', 1)->orderBy('id','desc')->paginate(30);
    // $orders = Order::orderBy('id', 'desc')->paginate(15);
    $sound='stop';
    $countorder=count($orders);
    $sessionCounter=Session::get('ordercnter');
    if($countorder> $sessionCounter)
    {
      $sound='play';
    }
    Session::put('ordercnter',count($orders));
    return view('order.index')->withOrders($orders)->withSound($sound);
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
