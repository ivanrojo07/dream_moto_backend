<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaMoto extends Model
{
    //
    protected $table = "marca_moto";

    protected $fillable=[
    	'id',
    	'nombre',
    	'descripcion',

    ];

    protected $hidden =[
    	'created_at',
    	'updated_at'
    ];

    public function modelo(){

    	return $this->hasOne('App\ModeloMoto','marca_id', 'id');

    }
}
