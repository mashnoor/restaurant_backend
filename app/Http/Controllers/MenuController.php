<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Menu;
use Session;
use App\Helper;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->paginate(10);
        return view('menu.index')->withMenus($menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Helper::categoryOptions();
        return view('menu.create',$data);
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
            'category_id'   => 'required',
            'code'          =>  'required',
            'name'          =>  'required',
            'description'   =>  'required',
            'price'         =>  'required|numeric',
            'image'         =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            // 'available'     =>  'required'
            ));

        $menu = new Menu;
        $menu->category_id  =   $request->category_id;
        $menu->code         =   $request->code;
        $menu->name         =   $request->name;
        $menu->description  =   $request->description;
        $menu->price        =   $request->price;
        // $menu->image        =   $request->image;
        // $menu->available    =   $request->available;
        $menu->save();

        if($file = $request->hasFile('image'))
        {
            $file       = $request->file('image') ;
            $extension  = $file->getClientOriginalExtension();
            $fileName   = $menu->id.".".$extension;

            $destinationPath = public_path().'/img/menus' ;
            $file->move($destinationPath,$fileName);
            $menu->image     =  $fileName;
            $menu->save();

        }        

        Session::flash('success', 'The new menu was successfully created!');

        return redirect()->route('menu.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);
        return view('menu.show')->withMenu($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        $categories = Helper::categoryOptions();
        return view('menu.edit')->withMenu($menu)->withCategories($categories);
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
            'category_id'   => 'required',
            'code'          =>  'required',
            'name'          =>  'required',
            'description'   =>  'required',
            'price'         =>  'required',
            'image'         =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ));

        $menu = Menu::find($id);
        $menu->category_id  =   $request->category_id;
        $menu->code         =   $request->code;
        $menu->name         =   $request->name;
        $menu->description  =   $request->description;
        $menu->price        =   $request->price;
        // $menu->image        =   $request->image;

        $menu->save();

        if($file = $request->hasFile('image'))
        {
            $file       = $request->file('image') ;
            $extension  = $file->getClientOriginalExtension();
            $fileName   = $menu->id.".".$extension;

            $destinationPath = public_path().'/img/menus' ;
            $file->move($destinationPath,$fileName);
            $menu->image     =  $fileName;
            $menu->save();

        } 

        Session::flash('success', 'The menu was successfully updated!');

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        $menu->delete();

        Session::flash('success', 'The menu was successfully deleted!');

        return redirect()->route('menu.index');
    }


}
