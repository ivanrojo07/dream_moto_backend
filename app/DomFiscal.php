<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class DomFiscal extends Model
{
    //
    use HasApiTokens, Notifiable;

    protected $table = "domicilio_fiscal";

    protected $fillable = [

    	"id",
    	"user_id",
    	"pais",
    	"estado",
    	"municipio",
    	"ciudad",
    	"colonia",
    	"calle",
    	"numext",
    	"numint"

    ];

    protected $hidden = [

    	"created_at", "updated_at"

    ];


    public function user(){

        return $this->belongsTo('App\User', 'user_id');

    }

}
