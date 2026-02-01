<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = [
        'product_id',
        'title',
        'type',
        'url',
        'content',
        'active',
];

   protected $casts = [
        'active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    
}
