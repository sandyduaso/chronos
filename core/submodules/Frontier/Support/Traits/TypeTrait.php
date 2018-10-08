<?php

namespace Frontier\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

trait TypeTrait
{
    /**
     * Gets all categories via given category type.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  string  $type
     * @param  string $column
     * @return Illuminate\Database\Eloquent\Model
     */
    public function scopeType(Builder $builder, $type, $column = 'type')
    {
        return $builder->where($column, $type);
    }
}
