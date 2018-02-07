<?php

namespace App\Http\Controllers;

use Validator;
use Auth;

use App\Order;
use App\Menu;
use App\Helper;
use App\Table;

use Illuminate\Http\Request;
use App\Http\Requests;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id',Auth::guard('api')->user()->id)->whereDate('created_at','=',date('Y-m-d'))->orderBy('id','DESC')->limit(20)->with('table')->get();
        $response=array(
            'status'=>1, 
            'msg'=>'Success!',
            'data'=>$orders->toArray()
            );
        return response()->json($response);
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
        $validator = Validator::make($request->all(), Order::rules());
        if($validator->fails())
        {

            $response=array(
                'status'=>0, 
                'msg'=>'Validation Error!',
                'data'=>$validator->errors()->toArray()
                );   
        }
        else
        {

            //preparing order lines
            $orderlines=array();
            $sub_total=0;

            foreach($request->items as $item)
            {
                $menu = Menu::find($item['menu_id']);
                
                if(!$menu->available)
                {
                    $response=array(
                        'status'=>0, 
                        'msg'=>'Item not available!',
                        'data'=>['menu_id'=>$menu->id]
                        );
                    return response()->json($response);                     
                }

                $price=$menu->price;
                $quantity=$item['quantity'];
                $discount=Helper::get_menu_discount($menu->id);

                $total=$price*$quantity;
                $total-=$total*$discount/100;

                $sub_total+=$total;

                $orderlines[$menu->id]=array(

                            'quantity'=>$quantity,
                            'price'=>$price,
                            'discount'=>$discount,
                            'total'=>$total
                    );
            }

            //preparing order
            $invoice_discount=Helper::get_invoice_discount();
            $amount_after_discount=$sub_total-($sub_total*$invoice_discount/100);
            $net_total=floor($amount_after_discount);
            $rounding_discount=number_format($amount_after_discount-$net_total,2);

            $table = Table::where('code',$request->table_code)->first();

            $order=new Order;
            $order->table_id=$table->id;
            $order->type='Table';
            $order->sub_total=$sub_total;
            $order->discount=$invoice_discount;
            $order->rounding_discount=$rounding_discount;
            $order->net_total=$net_total;
            $order->status=1;
            $order->user_id=Auth::guard('api')->user()->id;
            $order->save();

            $order->menus()->sync($orderlines);

            $table->status = 'occupied';
            $table->save();

            $response=array(
                'status'=>1, 
                'msg'=>'Order Submitted Successfully!',
                'data'=>['order_id'=>$order->id]
                );             
        }

        return response()->json($response);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);

        if(is_null($order))
        {
            $response=array(
                'status'=>0, 
                'msg'=>'Invalid Order ID',
                'data'=>[]
                );             
        }
        else
        {
            $order_summary=array(
                    'table_code'=>Table::find($order->table_id)->code,
                    'sub_total'=>$order->sub_total,
                    'discount'=>$order->discount,
                    'vat'=>$order->vat,
                    'rounding_discount'=>$order->rounding_discount,
                    'net_total'=>$order->net_total,
                    'status'=>$order->status
                );

            $orderlines=array();
            foreach($order->menus as $menu)
            {
                if($menu->image!='')
                    $image = asset('img/menus/'.$menu->image);
                else
                    $image = null;

                $orderlines[]=array(
                        'menu_id'=>$menu->id,
                        'code'=>$menu->code,
                        'name'=>$menu->name,
                        'quantity'=>$menu->pivot->quantity,
                        'price'=>$menu->pivot->price,
                        'discount'=>$menu->pivot->discount,
                        'total'=>$menu->pivot->total,
                        'image'=>$image
                    );
            }

            $response=array(
                'status'=>1, 
                'msg'=>'Order Found!',
                'data'=>['summary'=>$order_summary,'orderlines'=>$orderlines]
                );
        }

        return response()->json($response);
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
        $validator = Validator::make($request->all(), Order::rules());
        if($validator->fails())
        {

            $response=array(
                'status'=>0, 
                'msg'=>'Validation Error!',
                'data'=>$validator->errors()->toArray()
                );   
        }
        else
        {

            //preparing order lines
            $orderlines=array();
            $sub_total=0;

            foreach($request->items as $item)
            {
                $menu = Menu::find($item['menu_id']);
                
                if(!$menu->available)
                {
                    $response=array(
                        'status'=>0, 
                        'msg'=>'Item not available!',
                        'data'=>['menu_id'=>$menu->id]
                        );
                    return response()->json($response);                     
                }

                $price=$menu->price;
                $quantity=$item['quantity'];
                $discount=Helper::get_menu_discount($menu->id);

                $total=$price*$quantity;
                $total-=$total*$discount/100;

                $sub_total+=$total;

                $orderlines[$menu->id]=array(

                            'quantity'=>$quantity,
                            'price'=>$price,
                            'discount'=>$discount,
                            'total'=>$total
                    );
            }

            //preparing order
            $invoice_discount=Helper::get_invoice_discount();
            $amount_after_discount=$sub_total-($sub_total*$invoice_discount/100);
            $net_total=floor($amount_after_discount);
            $rounding_discount=number_format($amount_after_discount-$net_total,2);
			
				
            $order=Order::find($id);
			
			$table = Table::find($order->table_id);
			$table->status = 'free';
			$table->save();
			
            $order->table_id=Table::where('code',$request->table_code)->first()->id;
            $order->type='Table';
            $order->sub_total=$sub_total;
            $order->discount=$invoice_discount;
            $order->rounding_discount=$rounding_discount;
            $order->net_total=$net_total;
            $order->status=1;
            $order->user_id=Auth::guard('api')->user()->id;
            $order->save();

            $order->menus()->sync($orderlines);

            $response=array(
                'status'=>1, 
                'msg'=>'Order Updated Successfully!',
                'data'=>['order_id'=>$order->id]
                );             
        }

        return response()->json($response); 
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

    public function summary()
    {
        $orders = Order::where('user_id',Auth::guard('api')->user()->id)->whereDate('created_at','=',date('Y-m-d'))->where('status',5)->get();

        $response=array(
            'status'=>1, 
            'msg'=>'Success!',
            'data'=>array('order_count'=>$orders->count(),'order_value'=>$orders->sum('net_total'))
            );
        return response()->json($response);        
    }
}
