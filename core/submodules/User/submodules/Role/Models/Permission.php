<?php

namespace Role\Models;

use Pluma\Models\Model;
use Role\Support\Relations\BelongsToManyRoles;
use Role\Support\Traits\PermissionsFromModulesTrait;

class Permission extends Model
{
    use BelongsToManyRoles,
        PermissionsFromModulesTrait;

    protected $fillable = [
        'name',
        'code',
        'description',
        'group',
    ];

    protected $searchables = [
        'name',
        'code',
        'description',
        'updated_at',
        'created_at',
    ];
}
