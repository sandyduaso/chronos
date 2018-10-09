<?php

namespace Calendar\Support\Accessors;

trait CalendarAccessor
{
    /**
     * Get the three-letter acronym of the day.
     *
     * @return string
     */
    public function getDayletterAttribute()
    {
        return date('D', strtotime($this->weekday_name));
    }

    /**
     * Get the default date display.
     *
     * @return string
     */
    public function getDatedAttribute()
    {
        return date(settings('date_format', 'd-M-y'), strtotime($this->date));
    }
}
