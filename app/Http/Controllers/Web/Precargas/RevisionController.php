<?php

namespace App\Http\Controllers\Web\Precargas;

use App\Revision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('precargas.revision.index');
    }

    public function getRevisiones(){
        $revisiones= Revision::orderBy('created_at','asc')->get();

        return response()->json(['revisiones'=>$revisiones],201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $params = $request->params;
        // dd($params);
        $rules= [
            'params.nombre'=>'required',
            'params.costo'=>'required|numeric'
        ];
        $this->validate($request,$rules);
        $revision = Revision::create([
            'nombre'=> $params['nombre'],
            'costo'=>$params['costo']
        ]);

        return response()->json(['revision'=>$revision],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Revision  $revision
     * @return \Illuminate\Http\Response
     */
    public function show(Revision $revision)
    {
        //
        return response()->json(['revision'=>$revision],201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Revision  $revision
     * @return \Illuminate\Http\Response
     */
    public function edit(Revision $revision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revision  $revision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Revision $revision)
    {
        //
        $params = $request->params;
        // dd($params);
        $rules= [
            'params.nombre'=>'required',
            'params.costo'=>'required|numeric'
        ];
        $this->validate($request,$rules);
        $revision->update([
            'nombre'=> $params['nombre'],
            'costo'=>$params['costo']
        ]);

        return response()->json(['revision'=>$revision],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revision  $revision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revision $revision)
    {
        //
        $revision->delete();
        return response()->json(['revision'=>$revision],201);

    }
}
