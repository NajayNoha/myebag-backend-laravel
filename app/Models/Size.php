<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'size_type_id',
        'value'
    ] ;
    public function size_type()
    {
        return $this->belongsTo(SizeType::class, 'sizze_type_id', 'id');
    }
    public function product_variation()
    {
        return $this->belongsTo(ProductVariationt ::class, 'size_id', 'id');
    }
}
