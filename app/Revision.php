<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    //
    protected $table="revisions";

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
