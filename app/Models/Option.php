<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'option_name' => 'string',
        'option_value' => 'array',
    ];

    protected $fillable = [
        'option_name',
        'option_value',
    ];
}