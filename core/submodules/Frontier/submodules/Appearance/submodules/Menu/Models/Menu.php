<?php

namespace Menu\Models;

use Menu\Support\Traits\BelongsToMenu;
use Menu\Support\Traits\MenuBuilderTrait;
use Pluma\Models\Model;
use Pluma\Support\Database\Scopes\SlugOrFail;

class Menu extends Model
{
    use SlugOrFail, MenuBuilderTrait, BelongsToMenu;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];
}
