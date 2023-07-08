<?php


namespace App\Http\Filter;


use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    const PRICES = 'prices';
    const TAGS = 'tags';
    const SORT = 'sort_type';
    const SEARCH = 'search';
    protected function getCallbacks(): array
    {

        return [
            self::PRICES =>[$this, 'prices'],
            self::TAGS => [$this, 'tags'],
            self::SORT => [$this, 'sort'],
            self::SEARCH =>[$this, 'search'],
        ];

    }

    protected function prices(Builder $builder, $value)
    {
        $builder->whereBetween('price_special', $value);
    }

    protected function tags(Builder $builder)
    {

    }

    protected function sort(Builder $builder, $value)
    {
        $builder->orderBy($value[0], $value[1]);
    }

    protected function search(Builder $builder, $value)
    {
        $builder->where('title', 'like', '%'.$value.'%');
    }
}
