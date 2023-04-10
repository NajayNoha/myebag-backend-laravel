<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'discount_percent',
        'active'
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'discount_id', 'id');
    }
}
