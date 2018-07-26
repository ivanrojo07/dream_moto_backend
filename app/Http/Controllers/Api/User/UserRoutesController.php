<?php

namespace App\Http\Controllers\Api\User;

use App\Coordenate;
use App\Http\Controllers\Controller;
use App\Route;
use Illuminate\Http\Request;

class UserRoutesController extends Controller
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
        $rutas = $user->rutas()->orderBy('created_at','asc')->get();
        return response()->json(['rutas'=>$rutas],200);
        
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
        $data = json_decode($request->getContent(),true);
        $ruta = Route::create([
            'nombre'=> $data['finished'],
            'user_id'=>$user->id
        ]);

        $puntos = $data['path'];
        foreach ($puntos as $punto) {
            Coordenate::create([
                'long' => $punto['lng'],
                'lat' => $punto['lat'],
                'route_id'=>$ruta->id
            ]);
        }
        $ruta->coordenadas;

        return response()->json(['ruta'=>$ruta],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        //
    }
}
