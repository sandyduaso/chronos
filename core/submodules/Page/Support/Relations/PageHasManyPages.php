<?php

namespace Page\Support\Relations;

use Page\Models\Page;

trait PageHasManyPages
{
    /**
     * Page has many subpages.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    /**
     * Alias for pages.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getChildrenAttribute()
    {
        return $this->pages;
    }
}
