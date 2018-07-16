<?php

namespace App\Http\Controllers\Api\Producto;

use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos = Producto::orderBy('nombre','asc')->get();
        foreach ($productos as $producto) {
            $producto->producto;
            $producto->fotos;
        }
        return response()->json(['productos'=>$productos],200);
    }

}
