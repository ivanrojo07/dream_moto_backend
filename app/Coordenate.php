<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordenate extends Model
{
    //
    protected $table='coordenate_route';

    protected $fillable=[
    	'long',
    	'lat',
    	'route_id'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];

    public function ruta()
    {
    	return $this->belongsTo('App\Route','route_id');
    }
}
