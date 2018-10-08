<?php

namespace Fieldtype\Support\Relations;

use Fieldtype\Models\Fieldtype;

trait BelongsToFieldtype
{
    /**
     * Get the form that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function fieldtype()
    {
        return $this->belongsTo(Fieldtype::class);
    }
}
