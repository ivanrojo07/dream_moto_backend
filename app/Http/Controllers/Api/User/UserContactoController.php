<?php

namespace App\Http\Controllers\Api\User;

use App\Contacto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserContactoController extends Controller
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
        $contactos = $user->contactos;
        return response()->json(['contactos'=>$contactos],200);
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
        // dd($request->all());
        $user = $request->user();
        $contactos = $user->contactos;
        $rules = [
            'telefono'=>'required|numeric',
            'nombre'=>'nullable|string',
            'principal'=>'nullable|boolean',
            'averia'=>'nullable|boolean',
            'accidente'=>'nullable|boolean',
            'robo'=>'nullable|boolean'

        ];
        $this->validate($request,$rules);
        $contacto = Contacto::create([
            'user_id'=>$user->id,
            'nombre'=>$request->nombre,
            'numero'=>$request->telefono,
            'averia'=>$request->averia,
            'accidente'=>$request->accidente,
            'robo'=>$request->robo
        ]);
        if ($contactos->count() == 0 || $request->principal == true) {
            $contactos =$user->contactos;
            foreach ($contactos as $cont) {
                $cont->principal = false;
                $cont->save();
            }
            $contacto->principal = true;
            $contacto->save();
        }
        if($request->averia == true){
            $contacto->averia = true;
            $contacto->save();
        }

        if($request->accidente == true){
            $contacto->accidente = true;
            $contacto->save();
        }
        if($request->robo == true){
            $contacto->robo = true;
            $contacto->save();
        }
        return response()->json(['contacto'=>$contacto],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Contacto $contacto)
    {
        //
        $user = $request->user();
        if( $contacto->user_id == $user->id){
            return response()->json(['contacto'=>$contacto],200);
        }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto)
    {
        //
        // dd($request->all());
        $user = $request->user();
        if( $contacto->user_id == $user->id){
            if ($request->nombre || $request->telefono) {
                $contacto->update([
                'user_id'=>$user->id,
                'nombre'=>$request->nombre,
                'numero'=>$request->telefono,
                'averia'=>$request->averia,
                'accidente'=>$request->accidente,
                'robo'=>$request->robo
                ]);
            }
            if ($request->principal == true) {
                $contactos =$user->contactos;
                foreach ($contactos as $cont) {
                    $cont->principal = false;
                    $cont->save();
                }
                $contacto->principal = true;
                $contacto->save();
            }
            if($request->averia == true){
                $contacto->averia = true;
                $contacto->save();
            }

            if($request->accidente == true){
                $contacto->accidente = true;
                $contacto->save();
            }
            if($request->robo == true){
                $contacto->robo = true;
                $contacto->save();
            }

            if ($request->principal == false && $contacto->principal == true) {
                $cont = $user->contactos()->first();
                $cont->principal = true;
                $cont->save();
                $contacto->principal = false;
                $contacto->save();
            }
            if($request->averia == false){
                $contacto->averia = false;
                $contacto->save();
            }

            if($request->accidente == false){
                $contacto->accidente = false;
                $contacto->save();
            }
            if($request->robo == false){
                $contacto->robo = false;
                $contacto->save();
            }

            return response()->json(['contacto'=>$contacto],201);
        }
        else{
            return response()->json(['error'=>"sin permiso para editar este usuario"],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contacto $contacto)
    {
        //
        //
        $user = $request->user();
        if( $contacto->user_id == $user->id){
            $contacto->delete();
            if($contacto->principal == true){
                $contacto = $user->contactos()->first();
                $contacto->principal = true;
                $contacto->save();
            }
        }
        $contactos = $user->contactos;
        return response()->json(['contactos'=>$contactos],201);
    }
}
