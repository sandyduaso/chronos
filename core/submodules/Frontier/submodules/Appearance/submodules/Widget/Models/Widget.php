<?php

namespace Widget\Models;

use Pluma\Models\Model;
use Role\Support\Relations\BelongsToManyRoles;
use Widget\Support\Scopes\WidgetTrait;

class Widget extends Model
{
	use BelongsToManyRoles, WidgetTrait;

    protected $with = [];

    protected $fillable = ['id', 'name', 'code', 'description', 'icon', 'location', 'view', 'status'];

    protected $searchables = ['created_at', 'updated_at'];
}
