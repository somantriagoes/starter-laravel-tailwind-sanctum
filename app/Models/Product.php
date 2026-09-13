<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'image',
        'stock',
        'price',
        'created_by',
        'updated_by',
    ];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id'); // product.category_id
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price', 'product_id'); // price.product_id
    }
}
