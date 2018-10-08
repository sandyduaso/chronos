<?php

use Calendar\Models\Calendar;
use Pluma\Support\Database\Seeder;

class CalendarTableSeeder extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $startYear = date('Y');
        $endYear = $startYear + 2;

        $startDate = DateTime::createFromFormat('Y-m-d H:i:s', "$startYear-01-01 00:00:00");
        $endDate = DateTime::createFromFormat('Y-m-d H:i:s', "$endYear-31-12 23:59:59");
        $current = clone $startDate;

        while ($current < $endDate) {
            $date = $current->format('Y-m-d');
            $datetime = $current->format('Y-m-d H:i:s');


            $day = $current->format('d');
            $week = $current->format('W');
            $weekday = (int) $current->format('w'); // weekday num
            $weekend = in_array($current->format('D'), ['Sat', 'Sun']);
            $month = $current->format('n'); // month num
            $year = $current->format('Y');

            $monthName = $current->format('F');
            $weekdayName = $current->format('l');
            $holiday = in_array($current->format('m-d'), Calendar::holidays());

            $calendar = new Calendar();
            $calendar->date = $date;
            $calendar->datetime = $datetime;
            $calendar->weekend = $weekend;
            $calendar->day = $day;
            $calendar->month = $month;
            $calendar->year = $year;
            $calendar->week = $week;
            $calendar->weekday = $weekday;
            $calendar->month_name = $monthName;
            $calendar->weekday_name = $weekdayName;
            $calendar->holiday = $holiday;
            $calendar->save();

            $current = $current->modify('+1 day');
        }
    }
}
