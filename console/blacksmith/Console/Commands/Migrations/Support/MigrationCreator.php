<?php
namespace Blacksmith\Console\Commands\Migrations\Support;

use Closure;
use Illuminate\Database\Migrations;
use Illuminate\Database\Migrations\MigrationCreator as BaseMigrationCreator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use InvalidArgumentException;

class MigrationCreator extends BaseMigrationCreator
{
    /**
     * Get the path to the stubs.
     *
     * @return string
     */
    public function stubPath()
    {
        return blacksmith_path('templates/migrations');
    }

    /**
     * Ensure that a migration with the given name doesn't already exist.
     *
     * @param  string  $name
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function ensureMigrationDoesntAlreadyExist($name)
    {
        if (class_exists($className = $this->getClassName($name))) {
            $rc = new \ReflectionClass($className);
            throw new InvalidArgumentException("A {$className} class already exists in '{$rc->getFileName()}'.");
        }
    }
}
