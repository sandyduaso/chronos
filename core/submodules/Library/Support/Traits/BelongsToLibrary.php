<?php

namespace Library\Support\Traits;

use Library\Models\Library;

trait BelongsToLibrary
{
    /**
     * Get the library that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}
