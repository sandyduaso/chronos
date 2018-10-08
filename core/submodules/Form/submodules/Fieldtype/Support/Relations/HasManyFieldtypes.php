<?php

namespace Fieldtype\Support\Relations;

use Fieldtype\Models\Fieldtype;

trait HasManyFieldtypes
{
    /**
     * Fieldtype has many subfieldtypes.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fieldtypes()
    {
        return $this->hasMany(Fieldtype::class);
    }
}
