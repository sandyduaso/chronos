<?php

namespace Setting\Models;

use Setting\Models\Setting;
use Setting\Support\Traits\Keyable;

class General extends Setting
{
    protected $table = 'settings';

    protected $with = [];

    protected $searchables = ['key', 'value'];

    public function settings()
    {
        return $this->morphMany(Setting::class, 'settingable');
    }
}
