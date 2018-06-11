<?php

namespace App\Http\Controllers\Api\User;

use App\FotoMoto;
use App\Http\Controllers\Controller;
use App\Moto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Validation\Rule;


class UserMotoFotoMotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Moto $moto, Request $request)
    {
        //
        $user = $request->user();
        if($moto->user->id == $user->id){
            $fotos = $moto->fotos;
            $moto->marca;
            $moto->version;
            $moto->modelo;
            return response()->json(['moto'=>$moto],200);
        }
        else{
            return response()->json(['message'=>'no podemos mostrar esta moto'],500);
        }
        // dd($fotos);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Moto $moto, Request $request)
    {
        //
        $user = $request->user();
        if ($moto->user->id == $user->id) {
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
                        Storage::put('motos/'.$moto->id."/".$file_name,file_get_contents($image));
                        $foto = FotoMoto::create([
                            'moto_id' => $moto->id,
                            'image_path' => $moto->id.'/'.$file_name,
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
                    return response()->json(['message'=>'foto(s) suibidas con exito'],200);
                }
                
            } else {
                # code...
                return response()->json(['error'=>"No identificamos los archivos"],404);
            }
            
        } else {
            # code...
            return response()->json(['error'=>"No tienes permitido subir imagenes de esta moto"],404);
        }
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FotoMoto  $fotoMoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moto $moto,Request $request,FotoMoto $fotoMoto)
    {
        //
    }
}
