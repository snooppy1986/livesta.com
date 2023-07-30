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
        'brand_id'
    ];
    protected $guarded=[];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributes(): HasOne
    {
        return $this->hasOne(Attribute::class);
    }

    public function related(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_id');
    }

    public function category_product(): HasMany
    {
        return $this->hasMany(CategoryProduct::class);
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
        static::deleted(function (Product $product){

            $product->attributes()->each(function ($attribute){
                $attribute->delete();
            });

            $product->related()->each(function ($related){
                $related->delete();
            });

            $product->category_product()->each(function ($category_product){
                $category_product->delete();
            });
        });
    }
}
