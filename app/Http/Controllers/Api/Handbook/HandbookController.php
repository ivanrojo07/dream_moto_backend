<?php

namespace App\Http\Controllers\Api\Handbook;


use App\Handbook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HandbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $handbooks = Handbook::get();
        return response()->json(['handbooks'=>$handbooks],201);
    }


     /**
     * Download the file request.
     *
     * @return \Illuminate\Http\Response
     */

     public function download($path)
     {
        // dd($path);
        $file = Handbook::where('path',$path)->firstOrFail();
       
        // dd($nombre);
        if ($file->nombre){
             $nombre = Str::ascii($file->nombre);
            $nombre = str_slug($nombre,'_');
            return Storage::download('public/handbook/'.$path,$nombre.'.pdf');
        }
        else{
            return response()->json(['message'=>'Archivo no encontrado'],404);
        }
     }
}
