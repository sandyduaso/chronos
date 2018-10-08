<?php

namespace Calendar\Jobs;

use Calendar\Models\Calendar;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdjustCalendar implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The calendar object
     * @var Calendar\Models\Calendar
     */
    protected $calendar;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->calendar = $calendar;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return "calendar...";
    }
}
