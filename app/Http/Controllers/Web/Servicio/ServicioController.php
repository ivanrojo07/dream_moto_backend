<?php

namespace App\Http\Controllers\Web\Servicio;

use App\Servicio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicioController extends Controller
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
        $rules=[
            'estado'=>"required",
            'detalle'=>'required'
        ];
        $this->validate($request,$rules);
        $servicio = Servicio::create([
            'moto_id'=>$request->input('moto_id'),
            'estado'=>$request->input('estado'),
            'comentario'=>$request->input('comentario'),
            'detalle'=>$request->input('detalle'),
            'costo_obra'=>0,
            'costo_revision'=>0,
            'costo_refaccion'=>0,
            'total'=>0
        ]);
        $servicio->save();
        return response()->json(['servicio'=>$servicio]);
        // $servicio = Servicio::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        //
    }

    public function setRevision(Servicio $servicio, Request $request)
    {
        $rules = [
            'nombre'=>"required",
            'costo'=>"required|numeric"
        ];
        $this->validate($request,$rules);
        $servicio->inServicio()->updateOrCreate([
            'nombre'=>$request->nombre,
        ],[
            'nombre'=>$request->nombre,
            'costo'=>$request->costo,
            'tipo_servicio'=>'revision'
        ]);
        $servicio->setTotal();
        $revisiones = $servicio->inServicio()->where("tipo_servicio",'revision')->get();
        return response()->json(['servicio'=>$servicio,'revisiones'=>$revisiones],201);
    }

    public function setRefaccion(Servicio $servicio,Request $request)
    {
        $rules = [
            'nombre'=>"required",
            'costo'=>"required|numeric"
        ];
        $this->validate($request,$rules);
        $servicio->inServicio()->updateOrCreate([
            'nombre'=>$request->nombre,
        ],[
            'nombre'=>$request->nombre,
            'costo'=>$request->costo,
            'tipo_servicio'=>'refaccion',
            "comentario"=>$request->comentario
        ]);
        $servicio->setTotal();
        $refacciones = $servicio->inServicio()->where("tipo_servicio",'refaccion')->get();
        return response()->json(['servicio'=>$servicio,'refacciones'=>$refacciones],201);
    }
}
