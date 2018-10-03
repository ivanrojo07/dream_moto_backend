<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refaccion extends Model
{
    //
    protected $table="refaccions";

    protected $fillable=[
    	'id',
    	'nombre',
    	'costo'
    ];
    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];

}
