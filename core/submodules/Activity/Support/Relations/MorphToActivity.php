<?php

namespace Activity\Support\Relations;

trait MorphToActivity
{
    /**
     * Get all of the owning causer models.
     */
    public function causer()
    {
        return $this->morphTo();
    }
}
