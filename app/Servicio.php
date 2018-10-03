<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //

   	protected $table='servicios';
   	protected $fillable=[
   		'moto_id',
   		'estado',
   		'comentario',
   		'detalle',
   		'costo_obra',
   		'costo_revision',
   		'costo_refaccion',
   		'total'
   	];

   	protected $hidden = [
   		'moto_id',
   		'created_at',
   		'updated_at'
   	];

   	public function moto()
   	{
   		return $this->belongsTo('App\Moto');
   	}

   	public function inServicio(){
   		return $this->hasMany('App\InServicio');
   	}

}
