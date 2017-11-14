<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Table;
use Session;

class CashManagerController extends Controller
{
  public function orderManages()
  {
    $ordermanages = Order::orderBy('id', 'desc')->paginate(10);
    return view('manager.orderManages')->withOrdermanages($ordermanages);

    // $ordermanages = Order::where('status', '>', 2)->get();
    // return view('manager.orderManages')->withOrdermanages($ordermanages);
  }


  public function showCash($id)
  {     
    $ordermanages = Order::find($id);
    return view('manager.showCash')->withOrdermanages($ordermanages);
  }


  public function billSubmit()
  {
    $id = $_POST['id'];
    $orderManages = Order::find($id);
    $orderManages->status = 4;
    $orderManages->save();

    return  response()->json(['status'=>1,'id'=>$id]);
  }

  public function printInvoice($id)
  {

    $orderManages = Order::find($id);
    $orderManages->status = 4;
    $orderManages->save();

    return view('manager.printInvoice')->with('orderManages', $orderManages);
  }

  public function cashReceived($id)
  { 
    $orderManages = Order::find($id);
    $orderManages->status = 5;
    $orderManages->save();

    if($orderManages->save() && $orderManages->status == 5) {
      $table_id = Order::where('id', $id)->value('table_id');
      $updateTable = Table::find($table_id);
      $updateTable->status = 0;
      $updateTable->save();
    }

    return view('manager.cashReceived')->with('orderManages', $orderManages);
  }

  public function getPaymentModes(Request $request, $id)
  {
    $orderManages = Order::find($id);
    $orderManages->payment_modes = $request->payment_modes;
    $orderManages->cash_received = $request->nettotal - $request->cash_received;
    
    $orderManages->save();

    Session::flash('success', 'The payments was successfully received!');

    return redirect()->route('order.manages');
  }


}
