<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Support\Collection;
use RecursiveRelationships\Traits\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;
    protected $fillable=[
        'slug',
        'title',
        'parent_id',
        'thumbnail',
        'custom_id'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->with('children', 'products');
    }

    public function getCatIds(): Collection
    {
        $category_ids= new Collection();

        /*$category_products->push($this->products);*/
        foreach ($this->children as $child){
            $category_ids->push($child->id);
            $category_ids = $category_ids->merge($child->getCatIds());
        }
        $category_ids->push($this->id);
        return collect($category_ids)->unique();
    }
    public function ids(){
        return CategoryProduct::query()
            ->whereIn('category_id', $this->getCatIds())
            ->get()
            ->pluck('product_id');
    }



    public function parent(): HasOne
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function parents(): HasOne
    {
        return $this->hasOne(self::class, 'id', 'parent_id')
            ->with('parents');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Category $category){
            $category->slug = $category->slug ?? str($category->title)->slug();
        });
    }
}
