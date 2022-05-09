<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilnas_Poveiksimis_medziaga extends Model
{
    protected $table = 'Pilnas_Poveiksimis_medziaga';
    public $timestamps = false;
    protected $primaryKey = 'Id';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = ['VeiksnioApr','Id','VeiksnioId','Veiksnio_MedziagosApr','Pobudis','Periodas',
        'SveikatosTikrintojai1','SveikatosTikrintojai2','PivalomiTyrimai','PapildomosKontraindikacijos'];

    public function darbai()
    {
        return $this->belongsToMany(Darbai::class,'Darbai_Poveiksmis_medziaga', 'DarboKodas', 'Kodas');
    }
}
