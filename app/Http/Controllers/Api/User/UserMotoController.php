<?php

namespace App\Http\Controllers\Api\User;

use App\Moto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserMotoController extends Controller
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
        $motos = $user->motos()->with(['marca','modelo','version'])->get();

        return response()->json(['motos'=>$motos],200);

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
        $data = $request->all();
        $rules =[
            "marca"=>"required|numeric",
            'modelo'=>"required|numeric",
            "version"=>"required|numeric",
            "anio"=>"required|numeric",
            "km" =>"nullable|numeric",
            "num_serie"=>"nullable|numeric"
        ];
        $this->validate($request,$rules);
        $moto = Moto::create([
            "user_id" => $user->id,
            "marca_id" => $data['marca'],
            'modelo_id' => $data['modelo'],
            'version_id' => $data['version'],
            'anio' => $data['anio'],
            'km' => $data['km'],
            "serie" => $data['num_serie']
        ]);
        return response()->json(['moto'=>$moto],200);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Moto  $moto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$moto)
    {
        //
        $moto = Moto::with(['marca','modelo','version'])->findOrFail($moto);
        $user = $request->user();
        // dd($motocicleta);
        // $moto_user = $user->motos()->findOrFail($moto)->get();
        if ($moto->user->id == $user->id) {
            # code...
            return response()->json(['moto'=>$moto],200);
        } else {
            # code...
            return response()->json(['message'=>"No podemos mostrar esta moto"],500);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moto  $moto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moto $moto)
    {
        //
        $user = $request->user();
        $data = $request->all();
        $rules =[
            "km" =>"nullable|numeric"
        ];
        $this->validate($request,$rules);
        if ($moto->user->id == $user->id) {
            # code...
            $moto->update([
                'km' => $data['km']
            ]);
            return response()->json(['moto'=>$moto],200);
        }
        else{
            return response()->json(['message'=>'Moto no actualizada'],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moto  $moto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Moto $moto)
    {
        //
        $user = $request->user();
        if ($moto->user->id == $user->id) {
            # code...
            $moto->delete();
            return response()->json(['message'=>"Motocicleta eliminada de tu colección"],200);
        }
        else{
            return response()->json(['message'=>"No puedes eliminar esta moto"],500);
        }
    }
}
