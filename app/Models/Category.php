<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id'); // product.category_id
    }
}
