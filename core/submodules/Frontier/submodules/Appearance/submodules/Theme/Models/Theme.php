<?php

namespace Theme\Models;

use Setting\Models\Setting;
use Setting\Support\Traits\Themable;

class Theme extends Setting
{
    use Themable;

    protected $table = 'settings';

    protected $fillable = ['key', 'value'];

    protected $primaryKey = 'key';
}
