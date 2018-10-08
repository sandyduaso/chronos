<?php

namespace Setting\Models;

use Pluma\Models\Model;
use Setting\Support\Traits\Keyable;
use Setting\Support\Traits\Themes;

class Setting extends Model
{
    use Keyable, Themes;

    protected $fillable = ['key', 'value'];

    protected $primaryKey = 'key';
}
