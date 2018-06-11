<?php

namespace App\Http\Controllers\Api\Moto;

use App\Http\Controllers\Controller;
use App\ModeloMoto;
use App\VersionMoto;
use Illuminate\Http\Request;

class ModeloVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ModeloMoto $modelo)
    {
        //
        $versiones = $modelo->version()->get();
        return response()->json(['versiones'=>$versiones],200);
    }

}
