<?php

namespace Role\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Role\Support\Relations\BelongsToManyPermissions;
use User\Support\Traits\BelongsToManyUsers;

class Role extends Model
{
    use BelongsToManyUsers,
        BelongsToManyPermissions,
        SoftDeletes;

    protected $with = [];

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
