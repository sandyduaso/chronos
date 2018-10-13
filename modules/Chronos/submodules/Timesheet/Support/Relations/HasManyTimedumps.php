<?php

namespace Timesheet\Support\Relations;

use Timesheet\Models\Calendar;
use Timesheet\Models\Timedump;
use User\Models\User;

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
        $items = [];
        $this->timedumps()->where('timesheet_id', $this->id)->chunk(100, function ($timedumps) use (&$items) {
            foreach ($timedumps->groupBy('department') as $i => $timedump) {
                foreach ($timedump->groupBy('key') as $key => $date) {
                    $calendar = $this->dates([
                        'timesheet_id' => $this->id,
                        'key' => (string) $key,
                    ])->get();

                    $items[$i][$key]['calendar'] = $calendar;
                    $items[$i][$key]['key'] = $key;
                    $items[$i][$key]['metadata'] = json_decode($date[0]->metadata);
                    $items[$i][$key]['user'] = User::whereHas('details', function ($query) use ($key) {
                        $query->where('key', 'card_id');
                        $query->where('value', $key);
                    })->first();
                }
            }
        });

        return collect($items ?? []);
    }

    /**
     * Retrieve the complete dates from given range.
     *
     * @param  string $groupBy
     * @param  string $sortBy
     * @return mixed
     */
    public function lates($groupBy = 'date', $sortBy = 'date')
    {
        $items = [];
        $this->timedumps()->where('timesheet_id', $this->id)->chunk(100, function ($timedumps) use (&$items) {
            foreach ($timedumps->groupBy('key') as $key => $date) {
                $calendar = $this->dates([
                    'timesheet_id' => $this->id,
                    'key' => (string) $key,
                ])->get();

                $items[$key]['calendar'] = $calendar;
                $items[$key]['key'] = $key;
                $items[$key]['metadata'] = json_decode($date[0]->metadata);
                $items[$key]['user'] = User::whereHas('details', function ($query) use ($key) {
                    $query->where('key', 'card_id');
                    $query->where('value', $key);
                })->first();
            }
        });

        return collect($items ?? []);
    }
}
