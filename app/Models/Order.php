<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable=[
        'name',
        'surname',
        'phone',
        'email',
        'notes'
    ];

    public function order_product()
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }

    public static function boot()
    {
        parent::boot();
        static::deleted(function (Order $order){

            $order->orderProduct()->each(function ($orderProduct){
                $orderProduct->delete();
            });

        });
    }
}
