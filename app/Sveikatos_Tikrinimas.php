<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sveikatos_Tikrinimas extends Model
{
    protected $table = 'Sveikatos_Tikrinimas';
    public $timestamps = false;
    protected $primaryKey = 'Id';
    /*public $incrementing = false;*/
    protected $keyType = 'integer';
    protected $fillable = ['Id','Naudotojas','Data','Statusas','Sukurta',
        'Redaguota','Redaktorius','DarboKodas','Failas'];

    public function users()
    {
        return $this->belongsTo(User::class,'Naudotojas','username');
    }

    public function jobcode()
    {
        return $this->belongsTo(Darbai::class,'DarboKodas','Kodas');
    }

    public function status()
    {
        return $this->belongsTo(Statusai::class,'Statusas','Id');
    }
}

