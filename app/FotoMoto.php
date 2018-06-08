<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoMoto extends Model
{
    //
    protected $table="foto_moto";

    protected $fillable=[
    	'moto_id',
    	'image_path'
    ];

    protected $hiden=[
    	'created_at',
    	'updated_at'
    ];

    public function moto()
    {
    	# code...
    	return $this->belongsTo('App\Moto','moto_id');
    }
}
