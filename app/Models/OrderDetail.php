<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'oder_item_id', 'id');
    }
}