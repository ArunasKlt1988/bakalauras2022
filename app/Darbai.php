<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Darbai extends Model
{
    protected $table = 'Darbai';
    public $timestamps = false;
    protected $primaryKey = 'Kodas';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['Kodas','KodoApr'];

    public function roles()
    {
        return $this->hasMany(User::class);
    }

    public function irasai()
    {
        return $this->hasMany(Sveikatos_Tikrinimas::class);
    }

    public function pavojingidarbai()
    {
        return $this->belongsToMany(PavojingiDarbai::class,'Darbai_PavojingiDarbai','Kodas','DarboKodas');
    }

    public function medziagos()
    {
        return $this->belongsToMany(Pilnas_Poveiksimis_medziaga::class,'Darbai_Poveiksmis_medziaga','Kodas','DarboKodas');
    }

}
