<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'username';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Vardas', 'Pavarde','username', 'email', 'Role', 'DarboKodas', 'password', 'PabaigosData'
    ];


    public function roles(){
        return $this->belongsTo(Roles::class,'Role','Roles');
    }

    public function darbai(){
        return $this->belongsTo(Darbai::class,'DarboKodas','Kodas');
    }

    public function health(){
        return $this->hasMany(Sveikatos_Tikrinimas::class);
    }

    public function days(){
        return $this->belongsTo(DatosSkaiciuokle::class, 'username', 'Vartotojas');
    }




    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
