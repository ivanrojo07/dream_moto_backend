<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    //
    protected $table="moto";

    protected $fillable=[
    	'id',
    	'marca',
    	'modelo',
    	'version',
    	'user_id',
    	'anio',
    	'km',
    	'serie'
    ];
    protected $hidden =[
    	'created_at',
    	'updated_at'
    ];

    // public function marca()
    // {
    // 	# code...
    // 	return $this->belongsTo('App\MarcaMoto','marca_id');
    // }
    // public function modelo()
    // {
    // 	# code...
    // 	return $this->belongsTo('App\ModeloMoto','modelo_id');
    // }

    // public function version()
    // {
    // 	# code...
    // 	return $this->belongsTo('App\VersionMoto','version_id');

    // }

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
    public function servicios()
    {
        return $this->hasMany('App\Servicio','moto_id','id');
    }
}
