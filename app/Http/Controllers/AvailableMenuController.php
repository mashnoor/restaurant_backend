<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Menu;
use App\Helper;

class AvailableMenuController extends Controller
{

  public function showAvailableMenus()
  {
    $availables = Menu::orderBy('id', 'desc')->paginate(10);
    return view('order.availableMenu')->withAvailables($availables);
  }

  public function availableMenus($id)
  {
    $available = Menu::find($id);
    $available->available = 0;

    $available->save();

    return redirect()->back();
      
  }

  public function unavailableMenus($id)
  {
    $available = Menu::find($id);
    $available->available = 1;

    $available->save();

    return redirect()->back();
      
  }
  
}
