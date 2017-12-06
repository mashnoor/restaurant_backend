<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Menuorder;
use App\Table;
use Session;

class CashManagerController extends Controller
{

  public function orderManages()
  {
    $ordermanages = Order::where('status','>=',1)->orderBy('id', 'desc')->paginate(30);
    return view('manager.orderManages')->withOrdermanages($ordermanages);

    // $ordermanages = Order::where('status', '>', 2)->get();
    // return view('manager.orderManages')->withOrdermanages($ordermanages);
  }


  public function showCash($id)
  {     
    $ordermanages = Order::find($id);
    return view('manager.showCash')->withOrdermanages($ordermanages);
  }


  // public function billSubmit()
  // {
  //   $id = $_POST['id'];
  //   $orderManages = Order::find($id);
  //   $orderManages->status = 4;
  //   $orderManages->save();

  //   return  response()->json(['status'=>1,'id'=>$id]);
  // }


  public function printInvoice($id)
  {

    $orderManages = Order::find($id);
    $orderManages->status = 5;
    $orderManages->save();

    return view('manager.printInvoice')->with('orderManages', $orderManages);
  }


  public function submitBill($id)
  { 
    $orderManages = Order::find($id);
    // $orderManages->status = 5;
    // $orderManages->save();

    // if($orderManages->save() && $orderManages->status == 5) {
    //   $table_id = Order::where('id', $id)->value('table_id');
    //   $updateTable = Table::find($table_id);
    //   $updateTable->status = 0;
    //   $updateTable->save();
    // }

    return view('manager.cashReceived')->with('orderManages', $orderManages);
  }


  public function cashReceived(Request $request, $id)
  {
    // Error if both discout
    if($request->discount_cash  != 0 && $request->discount != 0)
    {
      Session::flash('danger', 'Both Discount not applicable at a time');
      return redirect()->back();
    }
    else
    {
      // Cash Discount
      if($request->discount_cash  !=  0)
      {
        $orderManages = Order::find($id);
        $orderManages->payment_modes = $request->payment_modes;   
        $orderManages->cash_received = $request->nettotal - $request->discount_cash;
        $orderManages->discount_cash = $request->discount_cash;
        $orderManages->discount =  0;
        $orderManages->save();
      }
      // Percentage Discount
      elseif($request->discount != 0)
      {
        $orderManages = Order::find($id);
        $menuorder = Menuorder::where('order_id', '=', $id)->get();
        $totaldiscount = 0;

        foreach ($menuorder as $value) {
          $menuid = $value->menu_id;
          $totalprice = $value->total;
          $discount =0;

          if($menuid != 48 && $menuid != 49 && $menuid != 50)
          {
            $discount = ($totalprice * $request->discount)/100;            
          }    
          $totaldiscount = $totaldiscount + $discount;     
        }
        $discountnettotal = $request->nettotal - $totaldiscount;

        $orderManages->payment_modes = $request->payment_modes;   
        $orderManages->cash_received = $discountnettotal;
        $orderManages->discount = $request->discount;
        $orderManages->discount_cash = 0;
        $orderManages->save();
      }
      else
      {
        $orderManages = Order::find($id);
        $orderManages->payment_modes = $request->payment_modes;   
        $orderManages->cash_received = $orderManages->net_total;
        $orderManages->discount = 0;
        $orderManages->discount_cash = 0;
        $orderManages->save();
      }
    }

    $orderManages = Order::find($id);
    $orderManages->status = 5;
    $orderManages->save();

    if($orderManages->save() && $orderManages->status == 5) {
      $table_id = Order::where('id', $id)->value('table_id');
      $updateTable = Table::find($table_id);
      $updateTable->status = 'free';
      $updateTable->save();
    }    

    Session::flash('success', 'The payments was successfully received!');

    // return redirect()->route('order.manages');
    return redirect()->route('order.printInvoice', ['id' => $id]);
  }


  // For Void Cash
  public function voidCash($id)
  {
    $voidcash = Order::find($id);
    return view('manager.cashVoid')->withVoidcash($voidcash);
  }


  public function voidPrint($id)
  {

    $orderManages = Order::find($id);
    $orderManages->status = 6;
    $orderManages->save();

    return view('manager.voidPrints')->with('orderManages', $orderManages);
  }
  

  public function updateVoidCash(Request $request, $id)
  {
    // Error if both discout
    if($request->discount_cash  != 0 && $request->discount != 0)
    {
      Session::flash('danger', 'Both Discount not applicable at a time');
      return redirect()->back();
    }
    else
    {
      // Cash Discount
      if($request->discount_cash  !=  0)
      {
        $orderManages = Order::find($id);
        $orderManages->payment_modes = $request->payment_modes;   
        $orderManages->cash_received = $request->nettotal - $request->discount_cash;
        $orderManages->discount_cash = $request->discount_cash;
        $orderManages->discount =  0;
        $orderManages->save();
      }
      // Percentage Discount
      elseif($request->discount != 0)
      {
        $orderManages = Order::find($id);
        $menuorder = Menuorder::where('order_id', '=', $id)->get();
        $totaldiscount = 0;

        foreach ($menuorder as $value) {
          $menuid = $value->menu_id;
          $totalprice = $value->total;
          $discount =0;

          if($menuid != 48 && $menuid != 49 && $menuid != 50)
          {
            $discount = ($totalprice * $request->discount)/100;            
          }    
          $totaldiscount = $totaldiscount + $discount;     
        }
        $discountnettotal = $request->nettotal - $totaldiscount;

        $orderManages->payment_modes = $request->payment_modes;   
        $orderManages->cash_received = $discountnettotal;
        $orderManages->discount = $request->discount;
        $orderManages->discount_cash = 0;
        $orderManages->save();
      }
      else
      {
        $orderManages = Order::find($id);
        $orderManages->payment_modes = $request->payment_modes;   
        $orderManages->cash_received = $orderManages->net_total;
        $orderManages->discount = 0;
        $orderManages->discount_cash = 0;
        $orderManages->save();
      }
    }

    $orderManages = Order::find($id);
    $orderManages->status = 6;
    $orderManages->save();   

    Session::flash('success', 'The payments was successfully received!');

    // return redirect()->route('order.manages');
    return redirect()->route('order.voidPrint', ['id' => $id]);
  }


}
