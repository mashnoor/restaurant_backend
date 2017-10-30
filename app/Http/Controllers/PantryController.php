<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;

class PantryController extends Controller
{
  public function index()
  {
    $pantrys = Order::orderBy('id', 'desc')->paginate(10);

    return view('pantry.index')->withPantrys($pantrys);
  }
  
}
