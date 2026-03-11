<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $fillable = ['name', 'slug'];

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'customer_type_product');
    }
}
