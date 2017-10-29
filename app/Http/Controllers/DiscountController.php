<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Discount;
use App\Helper;
use Session;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::orderBy('id', 'desc')->paginate(10);
        return view('discount.index')->withDiscounts($discounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['discounts'] = Helper::discountOptions(); 
        return view('discount.create', $data);
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
            'type'  =>   'required',
            'menu_id'   =>  'required',
            'from_date' =>  'required',
            'to_date'   =>  'required',
            'discount'  =>  'required',
            'active'    =>  'required'
        ));

        $discount = new Discount;
        $discount->type      =  $request->type;
        $discount->menu_id   =  $request->menu_id;
        $discount->from_date =  $request->from_date;
        $discount->to_date   =  $request->to_date;
        $discount->discount  =  $request->discount;
        $discount->active    =  $request->discount;

        $discount->save();

        Session::flash('success', 'The new discount was created!');

        return redirect()->route('discount.show', $discount->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discount = Discount::find($id);
        return view('discount.show')->withDiscount($discount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::find($id);
        $discounts = Helper::discountOptions();        
        return view('discount.edit')->withDiscount($discount)->withDiscounts($discounts);
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
            'type'      =>   'required',
            'menu_id'   =>  'required',
            'from_date' =>  'required',
            'to_date'   =>  'required',
            'discount'  =>  'required',
            'active'    =>  'required'
        ));

        $discount = Discount::find($id);

        $discount->type      =  $request->type;
        $discount->menu_id   =  $request->menu_id;
        $discount->from_date =  $request->from_date;
        $discount->to_date   =  $request->to_date;
        $discount->discount  =  $request->discount;
        $discount->active    =  $request->discount;

        $discount->save();

        Session::flash('success', 'The Discount was successfully updated!');

        return redirect()->route('discount.show', $discount->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);

        $discount->delete();

        Session::flash('success', 'The menu was successfully deleted!');

        return redirect()->route('discount.index');
    }
}
