<?php

namespace Pluma\Support\Database\Traits;

use Illuminate\Support\Facades\Artisan;

trait SeedDatabase
{
    /**
     * Array of migrations to migrate.
     *
     * @var array
     */
    protected $seeds;

    /**
     * Perform the migrate.
     *
     * @return void
     */
    public function seed()
    {
        Artisan::call('db:seed');
    }
}
