<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_link',
        'product_id',
        'title',
        'content',
        'status'
    ];
}
