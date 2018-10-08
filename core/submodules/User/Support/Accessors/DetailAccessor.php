<?php

namespace User\Support\Accessors;

trait DetailAccessor
{
    /**
     * Retrieve the mutated key value.
     *
     * @return string
     */
    public function getKeywordAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->key));
    }
}
