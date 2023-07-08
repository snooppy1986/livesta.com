<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RecursiveRelationships\Traits\HasRecursiveRelationships;

class Category extends Model

{
    use HasFactory;
    use HasRecursiveRelationships;
    protected $fillable=[
        'title',
        'parent_id',
        'translit',
        'custom_id'
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children', 'products');
    }

    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function ids()
    {
        return $this->children()->pluck('id');
    }
}
