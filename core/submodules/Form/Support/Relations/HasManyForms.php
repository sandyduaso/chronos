<?php

namespace Form\Support\Relations;

use Form\Models\Form;

trait FormHasManyForms
{
    /**
     * Form has many subforms.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
