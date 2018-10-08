<?php

namespace Theme\Models;

use Setting\Models\Setting;
use Setting\Support\Traits\Themes;

class Theme extends Setting
{
    use Themes;

    protected $table = 'settings';

    protected $fillable = ['key', 'value'];

    protected $primaryKey = 'key';
}
