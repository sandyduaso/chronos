<?php

namespace Library\Support\Traits;

use Library\Models\Library;

trait HasOneLibrary
{
    /**
     * Get the library record associated with the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function library()
    {
        return $this->hasOne(Library::class);
    }
}
