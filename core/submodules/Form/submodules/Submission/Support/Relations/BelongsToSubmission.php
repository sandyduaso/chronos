<?php

namespace Submission\Support\Relations;

use Submission\Models\Submission;

trait BelongsToSubmission
{
    /**
     * Get the form that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function form()
    {
        return $this->belongsTo(Submission::class);
    }
}
