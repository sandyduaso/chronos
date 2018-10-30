<?php

namespace Role\Models;

use Frontier\Support\Breadcrumbs\Accessors\Breadcrumable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Role\Support\Accessors\RoleAccessor;
use Role\Support\Relations\BelongsToManyPermissions;
use User\Support\Traits\BelongsToManyUsers;

class Role extends Model
{
    use BelongsToManyUsers,
        BelongsToManyPermissions,
        Breadcrumable,
        RoleAccessor,
        SoftDeletes;

    /**
     * The key to use for the breadcrumb middleware.
     *
     * @var string
     */
    protected $crumb = 'name';

    protected $fillable = [
        'name',
        'code',
        'alias',
        'description',
    ];

    protected $searchables = [
        'name',
        'code',
        'description',
        'created_at',
        'updated_at',
    ];
}
