<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'adresse',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

      public function temoignage()
    {
        return $this->belongsTo(Temoignage::class);
    }
}
