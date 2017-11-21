<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;


class LoginAdminController extends Controller
{

	public function getLogin()
	{
		return view('login');
	}


	public function postLogin(Request $request) {

    if (Auth::attempt(['username'=> $request->username, 'password'=> $request->password])) {
      return redirect('/admin');
    }
    return redirect()->back()->with('message','Invalid username & password combination');
  }


  public function getLogout(Request $request) {
    Auth::logout();
    return redirect('logins');
  }

}
