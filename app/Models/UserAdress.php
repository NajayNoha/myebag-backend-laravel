<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'adress_line1',
        'adress_line2',
        'city',
        'postal_code',
        'country',
        'telephone',
        'mobile',
    ];
}
