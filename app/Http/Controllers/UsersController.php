<?php

namespace App\Http\Controllers;

use Validator;
use Auth;                                                                                    
use Illuminate\Http\Request;
use App\Http\Requests;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Authorizes a user..
     *
     * @return json
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            $response=array(
                'status'=>0, 
                'msg'=>'Username or Password is missing',
                'data'=>$validator->errors()->toArray()
                );   
        }
        else
        {
            if(Auth::once($request->all())) 
            {
                $api_token=str_random(9);
                $user=Auth::user();
                $api_token.=$user->id;
                $user->api_token=$api_token;
                $user->save();

                $response=array(
                    'status'=>1, 
                    'msg'=>'Successfully Logged In!',
                    'data'=>array(
                        'api_token'=>$api_token,
                        'name'=>$user->name
                        )
                    );   
            }
            else
            {
                $response=array(
                    'status'=>0, 
                    'msg'=>'Invalid Username or Password',
                    'data'=>array()
                    );                  
            }            
        }

        return response()->json($response);        
    }
}
