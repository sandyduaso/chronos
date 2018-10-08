<?php

namespace Catalogue\Support\Traits;

trait MorphToCatalogable
{
    /**
     * Get all of the owning catalogable models.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function catalogable()
    {
        return $this->morphTo();
    }
}
