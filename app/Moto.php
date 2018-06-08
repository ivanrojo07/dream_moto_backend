<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    //
    protected $table="moto";

    protected $fillable=[
    	'id',
    	'marca_id',
    	'modelo_id',
    	'version_id',
    	'user_id',
    	'anio',
    	'km'
    ];
    protected $hidden =[
    	'created_at',
    	'updated_at'
    ];

    public function marca()
    {
    	# code...
    	return $this->belongsTo('App\MarcaMoto','marca_id');
    }
    public function modelo()
    {
    	# code...
    	return $this->belongsTo('App\ModeloMoto','modelo_id');
    }

    public function version()
    {
    	# code...
    	return $this->belongsTo('App\VersionMoto','version_id');

    }

    public function user()
    {
    	# code...
    	return $this->belongsTo('App\User','user_id');
    }
    public function fotos()
    {
    	# code...
    	return $this->hasMany('App\FotoMoto', 'moto_id', 'id');
    }
}
