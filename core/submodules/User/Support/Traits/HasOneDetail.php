<?php

namespace User\Support\Traits;

use User\Models\Detail;

trait HasOneDetail
{
    /**
     * Gets the model this resource has.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function detail()
    {
        return $this->hasOne(Detail::class);
    }
}
