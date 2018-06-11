<?php

namespace App\Http\Controllers\Api\Moto;

use App\MarcaMoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $marcas = MarcaMoto::get();
        return response()->json(['marcas'=>$marcas],200);
    }

}
