<?php

namespace User\Support\Traits;

use User\Models\User;

trait BelongsToUser
{
    /**
     * Gets the model this resource belongs to.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
