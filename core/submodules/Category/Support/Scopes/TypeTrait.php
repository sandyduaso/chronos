<?php

namespace Category\Support\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait TypeTrait
{
    /**
     * Gets all categories via given category type.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  string  $type
     * @return Illuminate\Database\Eloquent\Model
     */
    public function scopeType(Builder $builder, $type)
    {
        return $builder->where('type', $type);
    }
}
