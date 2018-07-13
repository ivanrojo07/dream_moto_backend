<?php

namespace App\Http\Controllers\Web\Tienda;

use App\FotoProducto;
use App\Producto;
use App\Tienda;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TiendaProductoFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tienda $tienda,Producto $producto)
    {
        //
        $fotos = $producto->fotos;
        return view('tiendas.producto.fotos.index',['tienda'=>$tienda,'producto'=>$producto,'fotos'=>$fotos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FotoProducto  $fotoProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tienda $tienda,Producto $producto,FotoProducto $foto)
    {
        //
        if($producto->id == $foto->producto_id){
            $delete =Storage::delete('/public/'.$foto->image_path);
            if ($delete) {
                $foto->delete();
                
            }
            
        }

        return redirect()->route('tiendas.productos.fotos.index',['tienda'=>$tienda,'producto'=>$producto]);


    }
}
