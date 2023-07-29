<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOption extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "delivery_options";
    protected $fillable = [
        'order_id',
        'type',
        'area',
        'city',
        'warehouse',
        'payment_type'
    ];
}
