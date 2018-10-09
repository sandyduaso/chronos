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
    public function dates($whereStatement = null, $startDate = null, $endDate = null)
    {
        return Calendar::build(
            (new Timedump)->getTable(),
            $whereStatement ?? ['timesheet_id' => $this->id],
            $startDate ?? $this->start_date,
            $endDate ?? $this->end_date
        );
    }

    /**
     * Retrieve the complete dates from given range.
     *
     * @param  string $sortBy
     * @return mixed
     */
    public function department($sortBy = 'date')
    {
        foreach ($this->timedumps->groupBy('department') as $i => $timedump) {
            foreach ($timedump->groupBy('key') as $key => $date) {
                $calendar = $this->dates([
                    'timesheet_id' => $this->id,
                    'key' => (string) $key,
                ])->get();

                $items[$i][$key] = $calendar;
            }
        }

        return collect($items ?? []);
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
        foreach ($this->timedumps->groupBy($groupBy) as $i => $timedump) {
            $calendar = $this->dates([
                'timesheet_id' => $this->id,
                $groupBy => $i,
            ])->get();

            $dates = $calendar->sortBy($sortBy)->groupBy('date');
            foreach ($dates as $date => $employees) {
                $items[$i][$date] = $employees->groupBy('key')->map(function ($item) {
                    return $item->first();
                });
            }
        }

        return $items ?? [];
    }
}
