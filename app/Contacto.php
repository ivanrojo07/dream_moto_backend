<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    //
    protected $table="contactos";

    protected $fillable=[
    	'id',
    	'user_id',
    	'nombre',
    	'numero',
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];

    public function user(){
    	return $this->belongsTo('App\User','id');
    }
}
