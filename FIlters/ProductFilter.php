<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter
{
    protected $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function filter(array $filters)
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    protected function product_name($value)
    {
        $this->builder->where('product_name', 'like', "%{$value}%");
    }

    protected function category($value)
    {
        $this->builder->whereHas('categories', function ($query) use ($value) {
            $query->where('category_name', 'like', "%{$value}%");
        });
    }

}
