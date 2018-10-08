<?php

namespace Timesheet\Support\Relations;

use Timesheet\Models\Timedump;

trait HasManyTimedumps
{
    /**
     * Gets the resources that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function timedumps()
    {
        return $this->hasMany(Timedump::class);
    }
}
