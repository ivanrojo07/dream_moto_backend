<?php

namespace App\Http\Controllers\Api\User;

use App\FotoProducto;
use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Http\Request;

class UserProductosFotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Producto $producto, Request $request)
    {
        //
        $fotos = $producto->fotos;
        return response()->json(['fotos'=>$fotos]);
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Producto $producto)
    {
        //

        $user = $request->user();
        $imagenes = json_decode($request->getContent(),true);
        if ($producto->producto_type == 'App\User' && $producto->producto_id == $user->id) {
            foreach ($imagenes as $imagens) {
            	# code...
            	// var_dump($imagens['imagen']);
                $image = $imagens['imagen'];
                $image = str_replace('data:image/jpg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10).'.'.'png';
                Storage::put(storage_path(). '/' . $imageName, base64_decode($image));
                $foto = FotoProducto::create([
                    'producto_id' => $producto->id,
                    'image_path' => '/'.$imageName,
                ]);  
                return response()->json(['message'=>'foto(s) suibidas con exito'],201);
            }
        }
       
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FotoProducto  $fotoProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Producto $producto,FotoProducto $fotoProducto)
    {
        //
        $user = $request->user();
        if ($producto->producto_type == 'App\User' && $producto->producto_id == $user->id && $producto->id == $fotoProducto->producto_id) {
            # code...
            Storage::delete('productos/'.$producto->id."/".$fotoProducto->image_path);
            $fotoProducto->delete();
            return response()->json(['message'=>"Foto eliminada"],200);
        } else {
            # code...
            return response()->json(['error'=>"No tienes permitido borrar imagenes de este producto"],401);
        }
        
    }
}
