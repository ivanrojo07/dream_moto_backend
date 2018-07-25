<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    //

    protected $table="route_user";

    protected $fillable=[
    	'user_id',
    	'nombre'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','user_id');

    }

    public function coordenadas(){
    	return $this->hasMany('App\Coordenate','route_id','id');
    }
}
