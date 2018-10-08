<?php

namespace Menu\Support\Traits;

use Menu\Models\Menu;

trait BelongsToMenu
{
    /**
     * Gets the menu that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}
