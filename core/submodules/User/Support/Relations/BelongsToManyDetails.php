<?php

namespace User\Support\Relations;

use User\Models\Detail;

trait BelongsToManyDetails
{
    /**
     * Gets all details resources associated
     * with this model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function details()
    {
        return $this->belongsToMany(Detail::class);
    }
}
