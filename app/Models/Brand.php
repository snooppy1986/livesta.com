<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed title
 * @property \Illuminate\Support\Stringable|mixed slug
 */
class Brand extends Model
{
    use HasFactory;
    protected $fillable=[
        'slug',
        'title',
        'thumbnail'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static ::creating(function (Brand $brand){
            $brand->slug = $brand->slug ?? str($brand->title)->slug();
        });
    }
}
