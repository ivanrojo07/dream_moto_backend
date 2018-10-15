<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Moto;
use App\Servicio;
use Illuminate\Http\Request;

class UserServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function misServicios(Request $request)
    {
        //
        $user = $request->user();
        $user_id = $user->id;

        $servicios = Servicio::whereHas('Moto',function($q) use ($user_id){
            $q->where('user_id',$user_id);
        })->with(['moto','moto.user','inServicio'])->get();
        // dd($servicios);
        // // $servicios = $servicios->moto()->where('user_id',$user->id)->get();
        // $servicios = $user->motos()->with(['servicios','servicios.inServicio'])->get();
        return response()->json(['servicios'=>$servicios],201);

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function servicio(Request $request,Servicio $servicio)
    {
        //
        $user = $request->user();
        $servicio->inServicio;
        // dd($servicio->moto->user);
        if ($servicio->moto->user->id == $user->id) {
            // dd($servicio);
            return response()->json(['servicio'=>$servicio],201);
        }
    }

     /**
     * Display the specified resource from model.
     *
     * @param  \App\Moto  $moto
     * @return \Illuminate\Http\Response
     */
     public function motoServicios(Request $request,Moto $moto)
    {
        //
        $moto->servicios;
        foreach ($moto->servicios as $servicio) {
            $servicio->inServicio;
        }
        $user = $request->user();
        if($moto->user->id == $user->id){
            return response()->json(['moto'=>$moto],201);
        }
    }
}