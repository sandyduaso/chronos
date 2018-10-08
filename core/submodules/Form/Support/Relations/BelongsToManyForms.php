<?php

namespace Form\Support\Relations;

use Form\Models\Form;

trait BelongsToManyForms
{
    /**
     * Get the forms that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }
}
