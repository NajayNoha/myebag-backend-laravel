<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sub_name'
    ];
    public function sizes()
    {
        return $this->hasMany(Size::class, 'size_type_id', 'id');
    }
}
