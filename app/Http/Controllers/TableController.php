<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Table;
use Session;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::orderBy('id', 'desc')->paginate(10);

        return view('table.index')->withTables($tables);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('table.create');
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
            'code'      =>  'required|numeric',
            'capacity'  =>  'required|numeric'
        ));

        $table = new Table;
        $table->code = $request->code;
        $table->capacity = $request->capacity;

        $table->save();

        Session::flash('success', 'The new table was successfully created!');

        return redirect()->route('table.show', $table->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Table::find($id);
        return view('table.show')->withTable($table);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Table::find($id);

        return view('table.edit')->withTable($table);
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
            'code'          =>  'required',
            'capacity'          =>  'required'
        ));

        $table = Table::find($id);

        $table->code        =   $request->code;
        $table->capacity    =   $request->capacity;

        $table->save();

        Session::flash('success', 'The table was successfully updated!');

        return redirect()->route('table.show', $table->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);

        $table->delete();

        Session::flash('success', 'The table was successfully deleted!');

        return redirect()->route('table.index');
    }
}
