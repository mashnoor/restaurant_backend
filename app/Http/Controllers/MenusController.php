<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Helper;
use Illuminate\Http\Request;
use App\Http\Requests;

class MenusController extends Controller
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
    public function show($code)
    {
        $menu=Menu::where('code',$code)->first();
        if(!is_null($menu))
        {
            $item=array(
                    'menu_id'=>$menu->id,
                    'code'=>$menu->code,
                    'name'=>$menu->name,
                    'description'=>$menu->description,
                    'price'=>$menu->price,
                    'image'=>$menu->image,
                    'available'=>$menu->available,
                );

            $response=array(
                    'status'=>1,
                    'msg'=>'Menu Item Found!',
                    'data'=>array('item'=>$item)
                );            
        }
        else
        {
            $response=array(
                    'status'=>0,
                    'msg'=>'Menu Item Not Found!',
                    'data'=>array()
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
     * Displays category wise menu items
     *
     * @param  int  $category_id
     * @return \Illuminate\Http\Response
     */
    public function category_wise_menus($category_id)
    {
        $menus=Menu::where('category_id',$category_id)->get();
        if($menus->count()>0)
        {
            $items=array();
            foreach($menus as $menu)
            {
                $items[]=array(
                    'menu_id'=>$menu->id,
                    'code'=>$menu->code,
                    'name'=>$menu->name,
                    'description'=>$menu->description,
                    'price'=>$menu->price,
                    'image'=>$menu->image,
                    'available'=>$menu->available,
                );                
            }

            $response=array(
                    'status'=>1,
                    'msg'=>'Menu Item Found!',
                    'data'=>array('items'=>$items)
                );            
        }
        else
        {
            $response=array(
                    'status'=>0,
                    'msg'=>'No menu item found in this category.',
                    'data'=>array()
                );            
        }

        return response()->json($response); 
    }
}
