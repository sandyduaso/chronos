<?php

use Activity\Models\Activity;
use Activity\Repositories\ActivityRepository;

if (! function_exists('activity')) {
    /**
     * Create an ActivityRepository instance helper.
     *
     */
    function activity($subject = null, $causer = null)
    {
        $repository = new ActivityRepository(new Activity());

        if (! is_null($subject)) {
            return $repository->log($subject, $causer);
        }

        return $repository;
    }
}
