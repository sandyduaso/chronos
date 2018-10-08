<?php

namespace Pluma\Support\Database;

use Pluma\Support\Database\Seeder;
use Pluma\Support\Modules\Traits\ModulerTrait;

class DatabaseSeeder extends Seeder
{
    use ModulerTrait;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeders = $this->getFilesFromModules('database/seeds');

        foreach ($seeders as $files) {
            collect($files)->each(function ($file) {
                $guessedClassName = basename($file->getFilename(), '.php');
                if (class_exists($guessedClassName)) {
                    $this->call($guessedClassName);
                }
            });
        }
    }
}
