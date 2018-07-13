<?php

namespace App\Http\Controllers\Web\Tienda;

use App\Http\Controllers\Controller;
use App\Producto;
use App\Tienda;
use App\FotoProducto;
use Illuminate\Support\Facades\Storage;
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
        return view('tiendas.producto.index',['tienda'=>$tienda,'productos'=>$productos]);
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
        // dd($request->all());
        // dd($imagenes);
        $inputs = $request->all();
        $rules = [
            'nombre'=>'required',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric',
            'imagen[]'=> 'image|mimes:jpg,jpeg,png',
        ];
        $imagenes = $request->imagen;
        $this->validate($request,$rules);
        $producto = Producto::create([
            "nombre" => $inputs['nombre'],
            'descripcion' => $inputs['descripcion'],
            'producto_id' => $inputs['tienda_id'],  
            'producto_type' => "App\Tienda",
            'cantidad' => $inputs['cantidad'],
            'precio' => $inputs['precio']
        ]);
        foreach ($imagenes as $imagen) {
            $path_image = $imagen->storeAs('productos/'.$producto->id,str_random(10).'.jpg','public');
            FotoProducto::create([
                'producto_id'=>$producto->id,
                'image_path'=>$path_image,
            ]);
        }


        return redirect()->route('tiendas.productos.index',['tienda'=>$tienda]);
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
        // return view('tiendas.producto.show',['producto'=>$producto,'tienda'=>$tienda]);
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
        $edit = true;
        return view('tiendas.producto.form',['tienda'=>$tienda,'producto'=>$producto, 'edit'=>$edit]);
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
        $inputs = $request->all();
        $rules = [
            'nombre'=>'required',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric',
        ];
        $this->validate($request,$rules);
        $producto->update([
            "nombre" => $inputs['nombre'],
            'descripcion' => $inputs['descripcion'],
            'cantidad' => $inputs['cantidad'],
            'precio' => $inputs['precio']
        ]);
        if ($request->imagen) {
            $imagenes = $request->imagen;
            foreach ($imagenes as $imagen) {
            $path_image = $imagen->storeAs('productos/'.$producto->id,str_random(10).'.jpg','public');
            FotoProducto::create([
                'producto_id'=>$producto->id,
                'image_path'=>$path_image,
            ]);
        }
        }
        return redirect()->route('tiendas.productos.index',['tienda'=>$tienda]);
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
        // dd($producto);
        if($producto->producto_id == $tienda->id && $producto->producto_type == 'App\Tienda'){
            foreach ($producto->fotos as $foto) {
                $delete =Storage::delete('/public/'.$foto->image_path);
                if ($delete) {
                    $foto->delete();
                }
            }
            $producto->delete();
        }
        return redirect()->route('tiendas.productos.index',['tienda'=>$tienda]);
    }
}
