<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_meta';
    protected $fillable=[
        'product_id',
        'description',
        'keywords'
    ];
}
