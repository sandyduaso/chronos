<?php

namespace Timesheet\Support\Punchcard;

use Carbon\Carbon;

class Punchcard
{
    /**
     * The default hours in seconds.
     *
     */
    public const DEFAULT_HOURS_IN_SECONDS = 3600;

    /**
     * The default minutes in seconds.
     *
     */
    public const DEFAULT_MINUTES_IN_SECONDS = 60;

    /**
     * The default seconds in seconds.
     *
     */
    public const DEFAULT_SECONDS_IN_SECONDS = 60;

    /**
     * The time in instance.
     *
     * @var time
     */
    protected $timeIn;

    /**
     * The time out instance.
     *
     * @var time
     */
    protected $timeOut;

    /**
     * Default values for reference.
     *
     * @var string
     */
    protected $defaultTimeIn = '08:00 AM';

    protected $defaultTimeOut = '05:00 PM';

    protected $defaultLunchStart = '12:00 PM';

    protected $defaultLunchEnd = '01:00 PM';

    protected $defaultGracePeriodInMorning = '00:00:00';

    protected $defaultGracePeriodInAfternoon = '00:00:00';

    /**
     * The Constructor of the class.
     * Initialize some variables.
     *
     * @param  array $params
     * @param  string $defaultTimeOut
     */
    public function __construct(array $params)
    {
        $this->defaultTimeIn = $params['default_time_in'] ?? $this->defaultTimeIn;
        $this->defaultTimeOut = $params['default_time_out'] ?? $this->defaultTimeOut;
        $this->defaultLunchStart = $params['default_lunch_start'] ?? $this->defaultLunchStart;
        $this->defaultLunchEnd = $params['default_lunch_end'] ?? $this->defaultLunchEnd;
    }

    /**
     * Calculate the total hourse of given times.
     *
     * @param  string $timeIn
     * @param  string $timeOut
     * @param  string $lunchStart
     * @param  string $lunchEnd
     * @return string
     */
    public function duration(string $timeIn, string $timeOut, $lunchStart = null, $lunchEnd = null)
    {
        $timeIn = $this->toSeconds($this->totalAM($timeIn, $lunchStart));
        $timeOut = $this->toSeconds($this->totalPM($timeOut, $lunchEnd));
        $duration = $timeOut + $timeIn;

        return $this->toTime($duration > 0 ? $duration : 0);
    }

    /**
     * Calculate the tardy time.
     *
     * @param string $timeIn
     * @param mixed $defaultTimeIn
     * @return string
     */
    public function tardy(string $timeIn, $defaultTimeIn = null)
    {
        $timeIn = $this->toSeconds($timeIn);
        $defaultTimeIn = $this->toSeconds(is_null($defaultTimeIn) ? $this->defaultTimeIn : $defaultTimeIn);
        $seconds = $timeIn - $defaultTimeIn;
        $tardy = $seconds > 0 ? $this->toTime($seconds) : $this->toTime(0);

        return $tardy;
    }

    /**
     * Calculate the overtime.
     *
     * @param string $timeOut
     * @param string $defaultTimeOut
     * @return string
     */
    public function overtime(string $timeOut, string $defaultTimeOut = null)
    {
        $timeOut = $this->toSeconds($timeOut);
        $defaultTimeOut = $this->toSeconds(is_null($defaultTimeOut) ? $this->defaultTimeOut : $defaultTimeOut);
        $overtime = $timeOut - $defaultTimeOut;

        return $this->toTime($overtime > 0 ? $overtime : 0);
    }

    /**
     * Calculate the under time.
     *
     * @param string $timeOut
     * @param string $defaultTimeOut
     * @return string
     */
    public function undertime(string $timeOut, string $defaultTimeOut = null)
    {
        $timeOut = $this->toSeconds($timeOut);
        $defaultTimeOut = $this->toSeconds($defaultTimeOut ?? $this->defaultTimeOut);
        $seconds = $defaultTimeOut - $timeOut;
        $undertime = $seconds > 0 ? $this->toTime($seconds) : $this->toTime(0);

        return $undertime;
    }

    /**
     * Calculate the offset hours.
     *
     * @param string $timeIn
     * @param string $timeOut
     * @return string
     */
    public function offset(string $timeIn, string $timeOut)
    {
        $tardytime = $this->toSeconds($this->tardy($timeIn));
        $overtime = $this->toSeconds($this->overtime($timeOut));
        $offset = $overtime - $tardytime;

        return $this->toTime($offset > 0 ? $offset : 0);
    }

    /**
     * Calculate the total hours in the morning since time in to lunch.
     *
     * @param string $timeIn
     * @param string $lunchStart
     * @return string
     */
    public function totalAM(string $timeIn, $lunchStart = null)
    {
        $timeIn = $this->toSeconds($timeIn);
        $lunchStart = $this->toSeconds(is_null($lunchStart) ? $this->defaultLunchStart : $lunchStart);
        $total = $lunchStart - $timeIn;

        return $this->toTime($total > 0 ? $total : 0);
    }

    /**
     * Calculate the total hours in the afternoon since lunch ends to time out.
     *
     * @param string $timeOut
     * @param string $lunchEnd
     * @return string
     */
    public function totalPM(string $timeOut, $lunchEnd = null)
    {
        $timeOut = $this->toSeconds($timeOut);
        $lunchEnd = $this->toSeconds(is_null($lunchEnd) ? $this->defaultLunchEnd : $lunchEnd);
        $total = $timeOut - $lunchEnd;

        return $this->toTime($total > 0 ? $total : 0);
    }

    /**
     * Calculate total lunch hours.
     *
     * @return string
     */
    public function getTotalLunchHours()
    {
        return $this->toTime($this->toSeconds($this->defaultLunchEnd) - $this->toSeconds($this->defaultLunchStart));
    }

    /**
     * Calculate the total number of lates.
     *
     * @return string
     */
    public function totalLateCount(object $dates, $key)
    {
        $times = [];
        foreach ($dates as $time) {
            $timeIn = $this->toSeconds($time->$key ?? '00:00:00');
            $defaultTimeIn = $this->toSeconds($this->defaultTimeIn);
            $times[] = (int) $timeIn > $defaultTimeIn;
        }

        return array_sum($times);
    }

    /**
     * Retrieve the max value from array.
     *
     * @param array $dates
     * @param string $key
     * @return string
     */
    public function maxFromArray($dates, $key)
    {
        $loops = [];
        foreach ($dates as $date) {
            $loops[] = $this->toSeconds($date->$key);
        }

        return $this->toTime(max($loops));
    }

    /**
     * Converts the string to time.
     *
     * @param  string $seconds
     * @return string
     */
    public function toTime($seconds = null)
    {
        $hours = floor((int) $seconds / self::DEFAULT_HOURS_IN_SECONDS);
        $minutes = floor((int) $seconds / self::DEFAULT_MINUTES_IN_SECONDS % self::DEFAULT_SECONDS_IN_SECONDS);
        $seconds = floor((int) $seconds % self::DEFAULT_SECONDS_IN_SECONDS);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    /**
     * Converts the string to seconds.
     *
     * @param string $time
     * @return string
     */
    public function toSeconds($time = null)
    {
        list($hours, $minutes, $seconds) = explode(':', date('H:i:s', strtotime($time)));

        $hours = $hours * self::DEFAULT_HOURS_IN_SECONDS;
        $minutes = $minutes * self::DEFAULT_MINUTES_IN_SECONDS;
        $seconds = $hours + $minutes + $seconds;

        return $seconds;
    }

    /**
     * Calculate the sum tota from associative array via key.
     *
     * @param array $dates
     * @param string $key
     * @return string
     */
    public function totalFromKey(array $dates, string $key)
    {
        foreach ($dates as $date) {
            $times[] = $this->toSeconds($date[$key] ?? '00:00:00');
        }

        return $this->toTime(array_sum($times ?? []));
    }
}
