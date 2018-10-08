<?php

namespace User\Support\Relations;

use User\Models\Detail;

trait HasManyDetails
{
    /**
     * Gets the resources that belongs to this resource.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
