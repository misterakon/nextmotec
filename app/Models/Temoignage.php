<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
     protected $fillable = [
        'customer_id',
        'titre',
        'contenue',
        'notation',
        'active'
    ];
    
    protected $casts = [
        'active' => 'boolean',
    
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
