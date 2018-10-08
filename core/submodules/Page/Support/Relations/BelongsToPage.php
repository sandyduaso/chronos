<?php

namespace Page\Support\Relations;

use Page\Models\Page;

trait BelongsToPage
{
    /**
     * Get the page that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function page()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }
}
