<?php

namespace App\Models;

use App\Models\Traits\Filtrable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Product extends Model
{
    use HasFactory;
    use Filtrable;
    protected $fillable=[
        'slug',
        'title',
        'image',
        'content',
        'code',
        'price_balls',
        'price_discount',
        'price_special',
        'price_through',
        'rating',
        'new',
        'brand_id'
    ];
    protected $guarded=[];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }

    public function attributes(): HasOne
    {
        return $this->hasOne(Attribute::class);
    }

    public function related(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_id');
    }


    public function category(): BelongsToMany
    {
         return $this->belongsToMany(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'DESC');
    }

    public function meta(): HasOne
    {
        return $this->hasOne(ProductMeta::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function (Product $product){
            $product->slug = $product->slug ?? str($product->title)->slug();
        });
    }
}
