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

    /**
     * Retrieve the time_in accessor.
     *
     * @return string
     */
    public function getTimeinAttribute()
    {
        return $this->time_in ?? date('H:i:s', strtotime('00:00:00'));
    }

    /**
     * Retrieve the time_in accessor.
     *
     * @return string
     */
    public function getTimeoutAttribute()
    {
        return $this->time_out ?? date('H:i:s', strtotime('00:00:00'));
    }

    /**
     * Retrieve the total_am accessor.
     *
     * @return string
     */
    public function getAmAttribute()
    {
        return $this->total_am ?? date('H:i:s', strtotime('00:00:00'));
    }

    /**
     * Retrieve the total_pm accessor.
     *
     * @return string
     */
    public function getPmAttribute()
    {
        return $this->total_pm ?? date('H:i:s', strtotime('00:00:00'));
    }

    /**
     * Retrieve the total_time accessor.
     *
     * @return string
     */
    public function getTotaltimeAttribute()
    {
        return $this->total_time ?? date('H:i:s', strtotime('00:00:00'));
    }
}
