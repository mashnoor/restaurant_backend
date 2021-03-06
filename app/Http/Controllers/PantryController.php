<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Menuorder;


class PantryController extends Controller
{
  public function index()
  {
    $pantrys = Order::where('status','>=',1)->orderBy('id', 'desc')->paginate(30);

    return view('pantry.index')->withPantrys($pantrys);
  }

  public function show($id)
  {
    $pantrys = Order::find($id);
    return view('pantry.show')->withPantrys($pantrys);
  }
  
}
