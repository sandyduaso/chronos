<?php

namespace Category\Models;

use Category\Support\Scopes\TypeTrait;
use Category\Support\Accessors\CategoryAccessor;
use Pluma\Models\Model;

class Category extends Model
{
    use CategoryAccessor,
        TypeTrait;

    protected $fillable = [
        'name',
        'alias',
        'code',
        'description',
        'icon',
        'type'
    ];

    protected $searchables = [
        'name',
        'alias',
        'type',
        'code',
        'description',
        'icon',
        'created_at',
        'updated_at',
    ];
}
