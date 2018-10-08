<?php

namespace Tests\Support\Test;

use Illuminate\Contracts\Console\Kernel;

trait DatabaseMigrations
{
    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @return void
     */
    public function runDatabaseMigrations()
    {
        $this->console('db:migrate');

        $this->beforeApplicationDestroyed(function () {
            $this->console('migration:rollback');

            RefreshDatabaseState::$migrated = false;
        });
    }
}
