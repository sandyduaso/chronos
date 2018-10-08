<?php

namespace Calendar\Models;

use Calendar\Support\Holidays\HolidaysTrait;
use Pluma\Models\Model;

class Calendar extends Model
{
    use HolidaysTrait;

    /**
     * Toggle timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
