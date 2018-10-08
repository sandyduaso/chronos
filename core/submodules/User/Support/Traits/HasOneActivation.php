<?php

namespace User\Support\Traits;

use User\Models\Activation;

trait HasOneActivation
{
    /**
     * Gets the model this resource has.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function activation()
    {
        return $this->hasOne(Activation::class);
    }
}
