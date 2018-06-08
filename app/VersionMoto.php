<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VersionMoto extends Model
{
    //

    protected $table="version_moto";

    protected $fillable=[
    	'id',
    	'modelo_id',
    	'nombre',
    	'descripcion'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];

    public function modelo(){
    	return $this->belongsTo('App\ModeloMoto','modelo_id');
    }
}
