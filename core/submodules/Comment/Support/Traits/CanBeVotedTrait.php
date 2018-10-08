<?php

namespace Comment\Support\Traits;

trait CanBeVotedTrait
{
    /**
     * Check if upvotes has value.
     *
     * @return boolean
     */
    public function hasUpvotes()
    {
        return ! is_null($this->upvotes) && $this->upvotes;
    }
}
