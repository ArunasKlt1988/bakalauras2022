<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class DatosSkaiciuokle extends Model
{
    use Notifiable;
    protected $table = 'DatosSkaiciuokle';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['Vartotojas', 'Pastas', 'DarboKodas', 'Periodas', 'Data', 'dienos'];

    public function vartotojai()
    {
        return $this->hasMany(User::class);
    }
}
