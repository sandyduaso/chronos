<?php

namespace User\Models;

use Pluma\Models\Model;
use User\Support\Accessors\DetailAccessor;
use User\Support\Traits\BelongsToUser;

class Detail extends Model
{
    use BelongsToUser,
        DetailAccessor;

    protected $fillable = ['user_id', 'icon', 'key', 'value'];

    protected $searchables = ['key', 'value'];
}
