<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttributes extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'user_id',
        'area',
        'city',
        'street',
        'house_number',
        'postcode'
    ];
}
