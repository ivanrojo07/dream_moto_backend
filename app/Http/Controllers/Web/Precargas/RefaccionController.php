<?php

namespace App\Http\Controllers\Web\Precargas;

use App\Refaccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        //
        return view('precargas.refaccion.index');
    }

    public function getRefacciones(){
        $refacciones= Refaccion::orderBy('created_at','asc')->get();

        return response()->json(['refacciones'=>$refacciones],201);
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
        $params = $request->params;
        // dd($params);
        $rules= [
            'params.nombre'=>'required',
            'params.costo'=>'required|numeric'
        ];
        $this->validate($request,$rules);
        $refaccion = Refaccion::create([
            'nombre'=> $params['nombre'],
            'costo'=>$params['costo']
        ]);

        return response()->json(['refaccion'=>$refaccion],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Refaccion  $refaccion
     * @return \Illuminate\Http\Response
     */
    public function show(Refaccion $refaccion)
    {
        //
        return response()->json(['refaccion'=>$refaccion],201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Refaccion  $refaccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Refaccion $refaccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Refaccion  $refaccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Refaccion $refaccion)
    {
        //
         $params = $request->params;
        // dd($params);
        $rules= [
            'params.nombre'=>'required',
            'params.costo'=>'required|numeric'
        ];
        $this->validate($request,$rules);
        $refaccion->update([
            'nombre'=> $params['nombre'],
            'costo'=>$params['costo']
        ]);

        return response()->json(['refaccion'=>$refaccion],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Refaccion  $refaccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refaccion $refaccion)
    {
        //
        $refaccion->delete();
        return response()->json(['refaccion'=>$refaccion],201);
    }
}
