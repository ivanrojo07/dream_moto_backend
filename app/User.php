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
        'password', 'remember_token',
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
}
