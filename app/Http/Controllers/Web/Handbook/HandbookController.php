<?php

namespace App\Http\Controllers\Web\Handbook;

use App\Handbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HandbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $handbooks = Handbook::orderBy('nombre','asc')->get();

        return view('handbook.index',['handbooks'=>$handbooks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $edit = false;
        return view('handbook.form',['edit'=>$edit]);
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function show(Handbook $handbook)
    {
        //
        return view('handbook.show',['handbook'=>$handbook]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Handbook $handbook)
    {
        //
        $edit = true;
        return view('handbook.form',['edit'=>$edit,'handbook'=>$handbook]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Handbook $handbook)
    {
        //
        $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handbook $handbook)
    {
        //
        
    }
}
