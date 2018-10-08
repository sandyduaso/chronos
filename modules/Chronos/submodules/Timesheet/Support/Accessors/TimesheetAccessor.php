<?php

namespace Timesheet\Support\Accessors;

trait TimesheetAccessor
{
    /**
     * Retrieve the user name.
     *
     * @return string
     */
    public function getUploaderAttribute()
    {
        return $this->user->displayname;
    }

    /**
     * Retrieve the timedumps associated.
     *
     * @return \Timesheet\Models\Timedump
     */
    public function getDataAttribute()
    {
        return $this->timedumps;
    }
}
