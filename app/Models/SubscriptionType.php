<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    protected $table = 'subscription_type';

    protected $fillable = [
        'product_id',
        'type',
        'titre',
        'price',
        'description',
        'achat_unique'
    ];

    protected $casts = [
        'achat_unique' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
