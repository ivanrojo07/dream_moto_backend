<?php

namespace App\Http\Controllers\Web\Tienda;

use App\Tienda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tiendas = Tienda::paginate(5);
        return view('tiendas.index',['tiendas'=>$tiendas]);
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
        return view('tiendas.form',['edit'=>$edit]);
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
         $rules = [
            'nombre'=> 'required',
            'nombre_contacto'=>'required',
            'puesto_contacto'=>'required',
            'correo_contacto'=>'required',
            'telefono_contacto'=>'required',
            'locacion'=> 'required',
            'telefono'=> 'required'
        ];
        $this->validate($request,$rules);
        $tienda = Tienda::create($request->all());

        return redirect()->route('tiendas.productos.create',['tienda'=>$tienda]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function show(Tienda $tienda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function edit(Tienda $tienda)
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
    public function update(Request $request, Tienda $tienda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tienda $tienda)
    {
        //
        foreach ($tienda->productos as $producto) {
            foreach ($producto->fotos as $foto) {
                $delete =Storage::delete('/public/'.$foto->image_path);
                if ($delete) {
                    $foto->delete();
                }
            }
            $producto->delete();
        }
        $tienda->delete();
        return redirect()->route('tiendas.index');
    }
}
