<?php

use Setting\Composers\SettingComposer;

return [
    [
        'appears' => ['Theme::partials.settingsbar'],
        'class' => SettingComposer::class
    ],
];
