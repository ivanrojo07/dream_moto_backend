<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoProducto extends Model
{
    //
    protected $table="foto_producto";

    protected $fillable=[
    	'producto_id',
    	'image_path',
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];

    public function producto(){

    	return $this->belongsTo('App\Producto','producto_id');
    }
}
