<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Order;
use App\User;
use App\Table;

class OrderController extends Controller
{

    public function index()
  {
    $orders = Order::where('status', '>=', 1)->orderBy('id','desc')->get();
    $orders2 = Order::where('status', '>=', 1)->orderBy('id','desc')->paginate(30);
    // $orders = Order::orderBy('id', 'desc')->paginate(15);
    $sound = 'stop';
    $countorder = count($orders);
    $sessionCounter = Session::get('ordercnter');
    if($countorder > $sessionCounter)
    {
      $sound = 'play';

    }
Session::put('ordercnter',count($orders));
    
    return view('order.index')->withOrders($orders2)->withSound($sound);
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
	
	$user = User::find($order->user_id);
	$reg_ids = array();
	array_push($reg_ids, $user->token);
	$order_res = array();
	$table = Table::find($order->table_id);
	
	$order_res['order_id'] = $id;
	$order_res['table_code'] = $table->code;
	
	

	
	$this->sendMessage($reg_ids, $order_res);
	

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
   public static function sendMessage($registrationIds, $post)
    {
        $firebase_api_key = "AAAAP_zysBA:APA91bFvp-X4wESqrIogi2hK5QlRfS22W_B4wpf3vfvkQ9tLjB14GFJD-ZI2csJeecvr0jfsNXZ4ypeV003l9g4l_zIzB-cwiOg8SamrMUixAYT0oRC-WZGVUjhaOYwLSk7EIc3wGt7N";


        $msg = array
        (
            'body' => $post

        );

        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $firebase_api_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;

    }
  


}
