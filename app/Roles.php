<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'Roles';
    public $timestamps = false;
    protected $primaryKey = 'Role';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['Roles','RolesApr'];

    public function roles()
    {
        return $this->hasMany(User::class);
    }
}
