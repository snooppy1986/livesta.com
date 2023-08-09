<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable=[
        'name',
        'surname',
        'phone',
        'email',
        'notes',
        'total_price'
    ];

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'order_user');
    }

    public function cart_item(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
    public function with_product()
    {
        return $this->cart_item()->with('product');
    }

    public function create_item($data){
        foreach ($data as $item){
            CartItem::create([
                'order_id' => $this->id,
                'product_id' => $item['product']['id'],
                'qty' => $item['qty']
            ]);
        }
    }

    public function create_delivery_method($data)
    {
        DeliveryOption::create([
            'order_id' => $this->id,
            'type' => $data['deliveryMethod'] ? $data['deliveryMethod'] : null,
            'area' => $data['deliveryAddress'] ? $data['deliveryAddress']['area'] : null,
            'city' => $data['deliveryAddress'] ? $data['deliveryAddress']['city'] : null,
            'warehouse' => $data['deliveryAddress'] ? $data['deliveryAddress']['warehouses'] : null,
            'payment_type' => $data['paymentMethod'] ? $data['paymentMethod'] : null
        ]);
    }
}
