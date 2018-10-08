<?php

namespace Timesheet\Models;

use Calendar\Models\Calendar as BaseCalendar;
use Calendar\Support\Holidays\HolidaysTrait;

class Calendar extends BaseCalendar
{
    /**
     * Toggle timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
