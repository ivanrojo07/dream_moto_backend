<?php

namespace App\Http\Controllers\Api\User;

use App\Contacto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserContactosController extends Controller
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
        $user = $request->user();
        $contactos = $user->contactos;
        $contacto = Contacto::create([
            'user_id'=>$user->id,
            'nombre'=>$request->nombre,
            'numero'=>$request->numero,
        ]);
        if ($contactos->length() == 0) {
            $contacto->principal = true;
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
        $user = $request->user();
        if( $contacto->user_id == $user->id){
            $contacto = Contacto::create([
            'user_id'=>$user->id,
            'nombre'=>$request->nombre,
            'numero'=>$request->numero,
            ]);
            if ($contactos->length() == 0) {
                $contacto->principal = true;
                $contacto->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
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
