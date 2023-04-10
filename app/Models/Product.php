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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function product_variation()
    {
        return $this->hasOne(ProductVariation::class);
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }
}