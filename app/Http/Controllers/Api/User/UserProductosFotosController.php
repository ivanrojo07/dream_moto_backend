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
        $imagenes = json_decode($request->getContent(),true);
        foreach ($imagenes as $imagens) {
        	# code...
        	var_dump($imagens['imagen']);
        }
        die();
        // var_dump($imagenes);
        // return response()->json([$imagenes],200);
        $user = $request->user();
        if ($producto->producto_type == 'App\User' && $producto->producto_id == $user->id) {
            # code...
            $inputs = $request->file('images');
            // dd($inputs);
            if (!empty($inputs)) {
                # code...
                $rules = [
                    'images'=>"image|mimes:jpg,jpeg,bmp,png"
                ];
                // dd($rules);
                // $this.validate($request,$rules);
                foreach ($inputs as $image) {
                    # code...
                    $foto = array('images' => $image);

                    $imageValidator = Validator::make($foto, $rules);
                    if (!$imageValidator->fails()) { 
                        $file_name =date("Y_m_d_His_").$image->getClientOriginalName();
                        // dd($image);
                        // dd($file_name);
                        Storage::put('productos/'.$producto->id."/".$file_name,file_get_contents($image));
                        $foto = FotoProducto::create([
                            'producto_id' => $producto->id,
                            'image_path' => $producto->id.'/'.$file_name,
                        ]);  
                    }
                    else{
                        $error = true;
                    }
                }
                if ($error) {
                    # code...
                    return response()->json(['message'=>'Alguna(s) foto(s) no pudieron ser subidas, verifiquen que sean archivos validos'],202);

                } else {
                    # code...
                    return response()->json(['message'=>'foto(s) suibidas con exito'],201);
                }
                
            } else {
                # code...
                return response()->json(['error'=>"No identificamos los archivos"],404);
            }
        } else {
            # code...
            return response()->json(['error'=>"No tienes permitido subir imagenes de este producto"],401);
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
