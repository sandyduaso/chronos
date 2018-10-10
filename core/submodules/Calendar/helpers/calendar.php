<?php

use Calendar\Models\Calendar;

if (! function_exists('calendar')) {
    /**
     * Calendar array from two dates
     *
     * @param  string  $startDate
     * @param  string  $endDate
     * @param  string  $key
     * @return array
     */
    function calendar($startDate, $endDate, $key = 'date')
    {
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));
        return Calendar::whereBetween($key, [$startDate, $endDate])->get();
    }
}
