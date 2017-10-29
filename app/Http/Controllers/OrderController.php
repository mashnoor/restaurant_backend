<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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

    return redirect()->back();
  }


  public function orderProcess($id)
  {
    $order = Order::find($id);
    $order->status = 2;

    $order->save();

    return redirect()->back();
  }


  public function orderManages()
  {  
    $ordermanages = Order::where('status', '>', 2)->get();

    return view('order.orderManages')->withOrdermanages($ordermanages);
  }


  public function showCash($id)
  {     
    $ordermanages = Order::find($id);
    return view('order.showCash')->withOrdermanages($ordermanages);
  }


  public function cashReceived($id)
  {
    $orderManages = Order::find($id);
    $orderManages->status = 4;

    $orderManages->save();

    return redirect()->back();
  }


  public function invoicePrint($id)
  {     
    $orderManages = Order::find($id);
    $orderManages->status = 5;

    $orderManages->save();

    return view('order.cashReceived')->with('orderManages', $orderManages);
  }


  // public function orderComplete($id)
  // {
  //   $orderManages = Order::find($id);
  //   $orderManages->status = 6;

  //   $orderManages->save();

  //   return redirect()->back();
  // }

}
