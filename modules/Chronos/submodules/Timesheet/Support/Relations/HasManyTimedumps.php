<?php

namespace Timesheet\Support\Relations;

use Timesheet\Models\Calendar;
use Timesheet\Models\Timedump;

trait HasManyTimedumps
{
    protected $calendar = Calendar::class;

    /**
     * Gets the resources that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function timedumps()
    {
        return $this->hasMany(Timedump::class)->orderBy('timedumps.date');
    }

    /**
     * Retrieve the complete dates from given range.
     *
     * @param array $whereStatement
     * @return mixed
     */
    public function dates($whereStatement = null)
    {
        return Calendar::build(
            (new Timedump)->getTable(),
            $whereStatement ?? ['timesheet_id' => $this->id],
            $this->start_date,
            $this->end_date
        );
    }

    /**
     * Retrieve the complete dates from given range.
     *
     * @param  string $groupBy
     * @param  string $sortBy
     * @return mixed
     */
    public function calendar($groupBy = 'date', $sortBy = 'date')
    {
        $calendar = Calendar::whereBetween('date', [$this->start_date, $this->end_date])->get();

        $items = [];
        foreach ($this->timedumps->groupBy('key') as $i => $timedump) {
            $timedump = $timedump->groupBy('date')->toArray();
            $timedump = array_merge($calendar->groupBy('date')->toArray(), $timedump);
            $items[(string) $i] = collect($timedump)->first();
            // $items[] = array_merge((array) $calendar->toArray(), (array) $timedump->toArray());
        }

        dd($items);
    }
}
