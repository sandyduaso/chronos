<?php

namespace Profile\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Setting\Support\Relations\HasManySettings;
use User\Models\User as BaseUser;

class User extends BaseUser
{
    use SoftDeletes, HasManySettings;
}
