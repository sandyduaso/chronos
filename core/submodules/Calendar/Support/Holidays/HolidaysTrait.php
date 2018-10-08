<?php

namespace Calendar\Support\Holidays;

trait HolidaysTrait
{
    /**
     * The array of holiday codes.
     *
     * @var array
     */
    protected $holidays = [
        '01-01', // New Year's Day
        '01-02', // New Year's Second Day ;) | Go Philippines!!!
        '02-08', // Chinese New Year | Ano, new year ulet?
        '02-25', // People's Power
        '03-20', // March equinox | Season
        // March | Maundy Thursday
        // March | Good Friday
        // March | Good Friday
        // March | Holy Saturday
        // March | Easter Sunday
        // '04-09', // Day of Valor
        '05-01', // Labor Day | A.K.A. Irony Day
        // '05-05', // Lailatul Isra Wal Mi Raj - Common Local holidays
        '06-12', // Independence Day
        // '06-20', // June Solstice | Season
        // '07-08', // Eidul-Fitar - Common Local holidays
        '08-21', // Ninoy Aquino Day
        '08-29', // National Heroe's Day
        '09-13', // Id-ul-Adha (Feast of the Sacrifice)
        // '09-22', September equinox | 22 - John Lioneil's birthday
        '10-31', // Special non-working Day
        '11-01', // All Saint's Day
        '11-02', // All Souls' Day
        '11-30', // Bonifacio Day
        // '12-21', // December Solsctice | Season
        '12-24', // Christmas Eve
        '12-25', // Christmas Day
        '12-30', // Rizal Day
        '12-31', // New Year's Eve
    ];

    /**
     * Array of calendar events.
     *
     * @var array
     */
    protected $events = [];

    /**
     * Merge Holidays.
     *
     * @param array $holidays
     */
    public function setHolidays($holidays)
    {
        array_merge($this->holidays, $holidays);
    }

    /**
     * Get array of Holidays.
     *
     * @return array
     */
    public static function holidays()
    {
        return (new static)->holidays;
    }

    /**
     * Get array of Events.
     *
     * @return array
     */
    public function events()
    {
        return $this->events;
    }
}
