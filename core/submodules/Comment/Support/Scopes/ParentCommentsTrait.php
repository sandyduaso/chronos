<?php

namespace Comment\Support\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait ParentCommentsTrait
{
    /**
     * Gets all top level comments only.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Course\Support\Traits\Model
     */
    public function scopeParents(Builder $builder)
    {
        return $builder->where('parent_id', null);
    }
}
