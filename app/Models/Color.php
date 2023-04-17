<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable =  [
        'name',
        'hex_code'
    ];
    public function product_variation()
    {
        return $this->hasMany(ProductVariation::class, 'color_id', 'id'); 
    }
}
