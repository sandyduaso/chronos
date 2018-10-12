<?php

namespace Timesheet\Models;

use Calendar\Support\Accessors\CalendarAccessor;
use Frontier\Support\Breadcrumbs\Accessors\Breadcrumable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Timesheet\Support\Accessors\TimesheetAccessor;
use Timesheet\Support\Relations\HasManyTimedumps;
use User\Support\Traits\BelongsToUser;

class Timesheet extends Model
{
    use SoftDeletes,
        Breadcrumable,
        BelongsToUser,
        HasManyTimedumps,
        CalendarAccessor,
        TimesheetAccessor;

    /**
     * The key to use for the breadcrumb middleware.
     *
     * @var string
     */
    protected $crumb = 'name';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'user_id',
    ];

    protected $searchables = [
        'name',
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    /**
     * Retrieve the chart data.
     *
     * @return string
     */
    public function chart()
    {
        $departments[0] = [__('Number of Lates')];
        $departments[0] = array_merge($departments[0], [30,200,100,400,150,250,50,100,1,3,4,250]);
        foreach ($this->department() as $department) {
            dd($department);
        }
        // $departments[1] = ['Total Lates', 1,100,100,150,200,250,250,3,30,4,400,50];

        return json_encode($departments ?? []);
    }
}
