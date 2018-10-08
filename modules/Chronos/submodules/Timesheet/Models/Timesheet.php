<?php

namespace Timesheet\Models;

use Frontier\Support\Breadcrumbs\Accessors\Breadcrumable;
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
        TimesheetAccessor;

    /**
     * The key to use for the breadcrumb middleware.
     *
     * @var string
     */
    protected $crumb = 'name';

    protected $fillable = [
        'name',
        'user_id',
    ];

    protected $searchables = ['created_at', 'updated_at'];
}
