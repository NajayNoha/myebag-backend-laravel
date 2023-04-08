<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'description',
        'category_id',
        'size_system',
        'gender',
        'discount_id',
    ];
    // public function category()
    // {
    //     return $this->hasOne(Category::class);
    // }
}
