<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PavojingiDarbai extends Model
{
    protected $table = 'PavojingiDarbai';
    public $timestamps = false;
    protected $primaryKey = 'Id';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $fillable = ['Id','DarboApr','Periodas','SveikatosTikrintojai1','SveikatosTikrintojai2',
        'PivalomiTyrimai','PapildomosKontraindikacijos'];

    public function darbai()
    {
        return $this->belongsToMany(Darbai::class,'Darbai_PavojingiDarbai', 'DarboKodas', 'Kodas');
    }
}
