<?php

namespace App\Http\Controllers\Web\Handbook;

use App\Handbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


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
        $handbooks = Handbook::orderBy('nombre','asc')->get();

        return view('handbook.index',['handbooks'=>$handbooks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $edit = false;
        return view('handbook.form',['edit'=>$edit]);
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
            // dd($_SERVER['CONTENT_LENGTH']);
        $rules = [
            'nombre'=>'required',
            'handbook'=> 'required|file|mimes:pdf',
        ];
        $this->validate($request,$rules);
        if ($request->file('handbook')->isValid()) {
            set_time_limit(0);
            ini_set('memory_limit','256M');
            ini_set('upload_max_filesize','256M');
            $file=$request->handbook;
            $path_name = str_random(10).'.pdf';
            $file->storeAs('public/handbook',$path_name);
            Handbook::create([
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'path'=>$path_name
            ]);
        }
        return redirect()->route('handbooks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function show(Handbook $handbook)
    {
        //
        return view('handbook.show',['handbook'=>$handbook]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Handbook $handbook)
    {
        //
        $edit = true;
        return view('handbook.form',['edit'=>$edit,'handbook'=>$handbook]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Handbook $handbook)
    {
        //
        // $request->all();
        $rules = [
            'nombre'=>'required',
        ];
        $this->validate($request,$rules);
        $handbook->update([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
        ]);
        return redirect()->route('handbooks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Handbook  $handbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handbook $handbook)
    {
        //
        $delete = Storage::delete('/public/handbook/'.$handbook->path);
        if ($delete) {
            $handbook->delete();
        }
        return redirect()->route('handbooks.index');
        
    }
}
