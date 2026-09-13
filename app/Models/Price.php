<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'hpp',
        'created_by',
        'updated_by',
    ];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id'); // price.product_id
    }
}
