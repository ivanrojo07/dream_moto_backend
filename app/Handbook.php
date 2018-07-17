<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Handbook extends Model
{
    //
    protected $table="handbooks";

    protected $fillable=[
    	'id',
    	'nombre',
    	'descripcion',
    	'path'
    ];

    protected $hidden =[
    	'created_at',
    	'updated_at'
    ];
}
