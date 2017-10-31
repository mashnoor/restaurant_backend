<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categores = Category::orderBy('id', 'desc')->paginate(10);
        return view('category.index')->withCategores($categores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'name'  => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));

        $category = New Category;

        $category->name = $request->name;
        // $category->image = $request->image;

        $category->save();

        if($file = $request->hasFile('image'))
        {
            $file       = $request->file('image') ;
            $extension  = $file->getClientOriginalExtension();
            $fileName   = $category->id.".".$extension;

            $destinationPath = public_path().'/img/categories' ;
            $file->move($destinationPath,$fileName);
            $category->image     =  $fileName;
            $category->save();
        } 

        Session::flash('success', 'The new category was successfully created!');

        return redirect()->route('category.create', $category->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('category.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit')->withCategory($category);
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
            'name' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));

        $category = Category::find($id);

        $category->name = $request->name;
        // $category->image = $request->image;

        $category->save();

        if($file = $request->hasFile('image'))
        {
            $file       = $request->file('image') ;
            $extension  = $file->getClientOriginalExtension();
            $fileName   = $category->id.".".$extension;

            $destinationPath = public_path().'/img/categories' ;
            $file->move($destinationPath,$fileName);
            $category->image     =  $fileName;
            $category->save();
        }

        Session::flash('success', 'The Category was successfully updated!');

        return redirect()->route('category.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        Session::flash('success', 'The category was successfully deleted!');

        return redirect()->route('category.index');
    }
}
