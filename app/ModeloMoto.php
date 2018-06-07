<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloMoto extends Model
{
    //
    protected $table = "modelo_moto";

    protected $fillable =[
    	'id',
    	'marca_id',
    	'nombre',
    	'descripcion'
    ];
    protected $hidden =[
    	'created_at',
    	'updated_at'
    ];
    public function marca(){

    	return $this->belongsTo('App\MarcaMoto','marca_id');

    }
    public function version(){

    	return $this->hasOne('App\VersionMoto','modelo_id','id');
    }
}
