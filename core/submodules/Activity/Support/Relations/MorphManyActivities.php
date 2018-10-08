<?php

namespace Activity\Support\Relations;

use Activity\Models\Activity;

trait MorphManyActivities
{
    /**
     * Get all of the post's comments.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'causer')->latest();
    }
}
