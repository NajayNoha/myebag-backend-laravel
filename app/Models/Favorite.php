<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "user_id",
        "value"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
