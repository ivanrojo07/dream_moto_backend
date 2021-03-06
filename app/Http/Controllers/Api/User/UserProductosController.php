<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = $request->user();
        $productos = $user->productos()->get();
        return response()->json(['productos'=>$productos],200);
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
        $user = $request->user();
        $inputs = $request->all();
        $rules = [
            'nombre'=>'required',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric',
        ];
        $this->validate($request,$rules);
        $producto = Producto::create([
            "producto_id"=> $user->id,
            "producto_type"=> "App\User",
            'nombre' => $inputs['nombre'],
            'descripcion'=> $inputs['descripcion'],
            'cantidad' => $inputs['cantidad'],
            'precio' => $inputs['precio']
        ]);
        return response()->json(['producto'=>$producto],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $usuarioProducto)
    {
        //
        $user = $request->user();
        if ($usuarioProducto->producto_type == 'App\User' && $usuarioProducto->producto_id == $user->id) {
            # code...
            $inputs = $request->all();
            $rules = [
                'nombre'=>'required',
                'cantidad' => 'required|numeric',
                'precio' => 'required|numeric',
            ];
            $this->validate($request,$rules);
            $usuarioProducto->update([
                "nombre" => $inputs['nombre'],
                'descripcion' => $inputs['descripcion'],
                'cantidad' => $inputs['cantidad'],
                'precio' => $inputs['precio']
            ]);
            return response()->json(['producto'=>$usuarioProducto],200);

        } else {
            # code...
            return response()->json(['error'=>"No puedes actualizar este producto"],401);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Producto $usuarioProducto)
    {
        //
        $user = $request->user();
        if ($usuarioProducto->producto_type == 'App\User' && $usuarioProducto->producto_id == $user->id) {
            # code...
            foreach ($usuarioProducto->fotos as $foto) {
                Storage::delete('/public/'.$foto->image_path);
                $foto->delete();
            }
            $usuarioProducto->delete();
            return response()->json(['message'=>"Producto eliminado de tu colección"],200);
        } else {
            # code...
            return response()->json(['message'=>"No puedes eliminar esta moto"],401);
        }
        
    }
}
