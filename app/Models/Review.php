<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_message_id')->with('children', 'reviews');
    }
}
