<?php

namespace Setting\Support\Relations;

use Setting\Models\Setting;

trait HasManySettings
{
    /**
     * Gets the resources that belongs to this resource.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }
}
