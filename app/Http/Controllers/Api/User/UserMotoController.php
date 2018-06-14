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
        $motos = $user->motos()->get();

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
            "marca"=>"required",
            "anio"=>"nullable|numeric",
            "km" =>"nullable|numeric",
            "serie" => "nullable|numeric"
        ];
        $this->validate($request,$rules);
        $moto = Moto::create([
            "user_id" => $user->id,
            "marca" => $data['marca'],
            'modelo' => $data['modelo'],
            'version' => $data['version'],
            'anio' => $data['anio'],
            'km' => $data['km'],
            'serie' => $data['serie']
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
            return response()->json(['message'=>"No podemos mostrar esta moto"],401);
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
            return response()->json(['message'=>'Moto no actualizada'],401);
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
            return response()->json(['message'=>"No puedes eliminar esta moto"],401);
        }
    }
}
