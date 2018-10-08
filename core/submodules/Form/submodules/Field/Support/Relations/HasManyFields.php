<?php

namespace Field\Support\Relations;

use Field\Models\Field;

trait HasManyFields
{
    /**
     * Field has many subfields.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fields()
    {
        return $this->hasMany(Field::class)->orderBy('sort', 'ASC');
    }
}
