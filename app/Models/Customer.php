<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
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
