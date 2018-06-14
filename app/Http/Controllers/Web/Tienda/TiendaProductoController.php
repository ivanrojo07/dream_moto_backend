<?php

namespace App\Http\Controllers\Web\Tienda;

use App\Http\Controllers\Controller;
use App\Producto;
use App\Tienda;
use Illuminate\Http\Request;

class TiendaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tienda $tienda)
    {
        //
        $productos = $tienda->productos()->get();
        dd($productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tienda $tienda)
    {
        //
        $edit = false;
        return view('tiendas.producto.form',['tienda'=>$tienda,'edit'=>$edit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Tienda $tienda,Request $request)
    {
        //
        $inputs = $request->all();
        $rules = ['nombre'=>"required"];
        $this->validate($request,$rules);
        $producto = Producto::create([
            "nombre" => $inputs['nombre'],
            'descripcion' => $inputs['descripcion'],
            'producto_id' => $tienda->id,
            'producto_type' => "App\Tienda",
            'cantidad' => $inputs['cantidad'],
            'precio' => $inputs['precio']
        ]);
        return redirect()->route('tiendas.productos.create',['tienda'=>$tienda]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function show(Tienda $tienda,Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function edit(Tienda $tienda,Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tienda $tienda,Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tienda $tienda, Producto $producto)
    {
        //
    }
}
