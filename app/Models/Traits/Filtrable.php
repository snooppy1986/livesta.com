<?php


namespace App\Models\Traits;


use App\Http\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

trait Filtrable
{
    public function scopeFilter(Builder $builder, FilterInterface $filter)
    {
        $filter->apply($builder);
        return $builder;
    }

}
