<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Helper;
use Hash;
use Session;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::orderBy('id','desc')->paginate(10);
    return view('user.index')->withUsers($users);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('user.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, array(
      'name'      =>  'required',
      'username'  =>  'required|unique:users,username',
      'user_type' =>  'required',
      'password'  =>  'required|min:4',

    ));

    $user = new User;

    $user->name         =   $request->name;
    $user->username     =   $request->username;
    $user->user_type    =   $request->user_type;
    $user->password     =   Hash::make($request->password);

    $user->save();

    Session::flash('success', 'The new user was successfully created!');

    return redirect()->route('user.index');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::find($id);
    return view('user.show')->withUser($user);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::find($id);
    
    return view('user.edit')->withUser($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, array(
      'name'      =>  'required',
      'username'  =>  'required',
      'user_type' =>  'required',
      'password'  =>  'required|min:4',

    ));

    $user = User::find($id);

    $user->name         =   $request->name;
    $user->username     =   $request->username;
    $user->user_type    =   $request->user_type;
    $user->password     =   Hash::make($request->password);

    $user->save();

    Session::flash('success', 'The user was successfully updated!');

    return redirect()->route('user.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = User::find($id);

    $user->delete();

    Session::flash('success','The user was successfully deleted!');

    return redirect()->route('user.index');
  }
}
