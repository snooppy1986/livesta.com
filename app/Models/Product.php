<?php

namespace App\Models;

use App\Models\Traits\Filtrable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Filtrable;
    protected $guarded=[];

    public function attributes()
    {
        return $this->hasOne(Attribute::class);
    }

    public function related()
    {
        return $this->hasMany(RelatedProduct::class);
    }

    public function category_product()
    {
        return $this->hasMany(CategoryProduct::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
    public function cat_ids()
    {
        return $this->category_product()->pluck('category_id');
    }
    public function related_ids()
    {
        return $this->related()->pluck('related_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'DESC');
    }

    public static function boot()
    {
        parent::boot();
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
