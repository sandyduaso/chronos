<?php

namespace User\Support\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait ScopeDetailTrait
{
    /**
     * Query from given key.
     *
     * @param  string  $key
     * @param  string  $default
     * @return string
     */
    public function scopeDetail(Builder $builder, $key, $default = "")
    {
        return $builder->where('key', $key)->first();
    }
}
