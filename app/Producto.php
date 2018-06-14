<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table="producto";

    protected $fillable=[
    	'id',
    	'nombre',
    	'descripcion',
    	'producto_id',
    	'producto_type',
    	'cantidad',
    	'precio'

    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    ];

    public function producto(){
    	return $this->morphTo();
    }
}
