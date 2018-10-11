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
   	];

   	public function moto()
   	{
   		return $this->belongsTo('App\Moto');
   	}

   	public function inServicio(){
   		return $this->hasMany('App\InServicio');
   	}
      public function setTotal(){
         $revisiones =  $this->inServicio()->where('tipo_servicio','revision')->get();

         $costo_rev = 0.00;
         foreach ($revisiones as $rev) {
            $costo_rev += $rev->costo;
         }
         $refacciones =  $this->inServicio()->where('tipo_servicio','refaccion')->get();
         
         $costo_ref = 0.00;
         foreach ($refacciones as $ref) {
            $costo_ref += $ref->costo;
         }
         $this->costo_refaccion = $costo_ref;
         $this->costo_revision = $costo_rev;
         $total = $this->costo_revision+$this->costo_obra+$this->costo_refaccion;
         $this->total = $total;
      }

}
