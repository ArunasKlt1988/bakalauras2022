<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statusai extends Model
{
    protected $table = 'Statusai';
    public $timestamps = false;
    protected $primaryKey = 'Id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['Id','StatusoApr'];

    public function irasai()
    {
        return $this->hasMany(Sveikatos_Tikrinimas::class);
    }
}
