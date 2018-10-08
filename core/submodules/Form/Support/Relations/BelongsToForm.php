<?php

namespace Form\Support\Relations;

use Form\Models\Form;

trait BelongsToForm
{
    /**
     * Get the form that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
