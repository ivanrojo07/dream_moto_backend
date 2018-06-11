<?php

namespace App\Http\Controllers\Api\Moto;

use App\MarcaMoto;
use App\ModeloMoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarcaModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MarcaMoto $marca)
    {
        //
        $modelos = $marca->modelo()->get();
        return response()->json(['modelos'=>$modelos],200);
    }

}
