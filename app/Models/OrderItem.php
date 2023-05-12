<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_variation_id',
        'order_detail_id',
    ];

    public function orderDetails()
    {
        return $this->belongsTo(OrderDetail::class,  'oder_item_id', 'id');
    }

    public function product_variation() {
        return $this->belongsTo(ProductVariation::class);
    }
}
