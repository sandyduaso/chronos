<?php

use Faker\Generator;
use Role\Models\Role;

$factory->define(Role::class, function (Generator $faker) {
    return [
        'name' => 'Super Administrator',
        'alias' => 'Superadmin',
        'code' => 'superadmin',
        'description' => 'The highest role available for users. It is recommended app must have atleast one user under this role.',
    ];
});

$factory->state(Role::class, 'superadmin', function (Generator $faker) {
    return [
        'name' => 'Super Administrator',
        'alias' => 'Superadmin',
        'code' => 'superadmin',
        'description' => 'The highest role available for users. It is recommended app must have atleast one user under this role.',
    ];
});

$factory->state(Role::class, 'admin', function (Generator $faker) {
    return [
        'name' => 'Administrator',
        'alias' => 'Admin',
        'code' => 'admin',
        'description' => 'The official site role. Manages creation of other users, and everything related to the site.',
    ];
});
