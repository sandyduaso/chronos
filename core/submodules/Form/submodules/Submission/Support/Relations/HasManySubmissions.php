<?php

namespace Submission\Support\Relations;

use Submission\Models\Submission;

trait HasManySubmissions
{
    /**
     * Submission has many subforms.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
