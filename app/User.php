<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'appaterno', 'apmaterno', 'email', 'telefono', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at'
    ];

    public function domFiscal(){

        return $this->hasOne('App\DomFiscal', 'user_id', 'id');

    }

    public function domEnvio(){

        return $this->hasMany('App\DomEnvio', 'user_id', 'id');

    }

    public function tarjetas(){

        return $this->hasMany('App\Tarjeta', 'user_id', 'id');

    }

    public function motos(){

        return $this->hasMany('App\Moto','user_id','id');
    }
    public function productos(){
        return $this->morphMany('App\Producto','producto');
    }
    public function rutas()
    {
        return $this->hasMany('App\Route','user_id','id');
    }
    public function contactos()
    {
        return $this->hasMany('App\Contacto','user_id','id');
    }
}
