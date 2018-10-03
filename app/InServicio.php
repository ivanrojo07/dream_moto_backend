<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InServicio extends Model
{
    //
    protected $table="in_servicios";

    protected $fillable=[
    	'id',
    	'tipo_servicio',
    	'servicio_id',
    	'nombre',
    	'costo',
    	'comentario'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];

    public function servicio(){
    	return $this->belongsTo('App\Servicio');
    }

}
