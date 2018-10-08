<?php

namespace Activity\Support\Accessors;

trait ActivityAccessor
{
    /**
     * Retrieve the mutated subject blurb.
     *
     * @return string
     */
    public function getLoggedAttribute()
    {
        return $this->subject;
    }
}
