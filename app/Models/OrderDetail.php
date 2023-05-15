<?php

namespace App\Models;

use Google\Service\AndroidEnterprise\Resource\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'order_status_id'
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment_detail() {
        return $this->hasOne(PaymentDetail::class, 'order_detail_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }
}
