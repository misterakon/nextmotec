<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'customer_type_id',
        'name',
        'description',
        'price',
        'short_desc',
        'long_desc',
        'image',
        'active',
    ];
    
    protected $casts = [
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function documentations()
    {
        return $this->hasMany(Documentation::class);
    }

    

}
