<?php

namespace Field\Support\Relations;

use Field\Models\Field;

trait BelongsToField
{
    /**
     * Get the field that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
