<?php

namespace Timesheet\Models;

use Illuminate\Database\Eloquent\Builder;
use Pluma\Models\Model;

class Timedump extends Model
{
    protected $fillable = [
        'date',
        'department',
        'key',
        'time_in',
        'time_out',
        'total_am',
        'total_pm',
        'total_time',
        'tardy_time',
        'under_time',
        'over_time',
        'offset_hours',
        'user_id',
        'timesheet_id',
        'metadata',
    ];

    protected $searchables = ['created_at', 'updated_at'];
}
