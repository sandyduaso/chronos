<?php

namespace Catalogue\Support\Traits;

use Library\Models\Library;

trait HasManyLibraries
{
    /**
     * Get the library objects for this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function libraries()
    {
        return $this->hasMany(Library::class);
    }
}
