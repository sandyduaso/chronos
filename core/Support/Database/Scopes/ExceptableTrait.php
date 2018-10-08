<?php

namespace Pluma\Support\Database\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait ExceptableTrait
{
    /**
     * Exclude the given from the resource.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  mixed $ommitables
     * @param  string $column
     * @return $builder
     */
    public function scopeExcept(Builder $builder, $ommitables = [], $column = "code")
    {
        return $builder->whereNotIn($column, (array) $ommitables);
    }

    /**
     * Alias of except.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  mixed $ommitables
     * @param  string $column
     * @return $builder
     */
    public function scopeOmmit($builder, $ommitables = [], $column = "code")
    {
        return $this->except($builder, (array) $ommitables, $column);
    }
}
