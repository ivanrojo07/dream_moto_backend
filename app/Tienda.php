<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    //

    protected $table="tienda";

    protected $fillable=[
    	'id',
    	'nombre',
    	'descripcion',
    	'nombre_contacto',
    	'puesto_contacto',
    	'correo_contacto',
    	'telefono_contacto',
    	'telefono',
    	'long',
    	'lat',
    	'locacion'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    ];

    public function productos(){
    	return $this->morphMany('App\Producto','producto');
    }

    public function getMapLink(){
        return 'https://www.google.com.mx/maps?q=' . $this->lat . ',' . $this->long;
    }


}
