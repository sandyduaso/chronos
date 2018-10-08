<?php

namespace Blacksmith\Console\Commands\Migrations\Support;

use Blacksmith\Support\Console\Command;

class BaseCommand extends Command
{
    /**
     * Get all of the migration paths.
     *
     * @return array
     */
    protected function getMigrationPaths()
    {
        // Here, we will check to see if a path option has been defined. If it has we will
        // use the path relative to the root of the installation folder so our database
        // migrations may be run for any customized path from within the application.
        if ($this->input->hasOption('path') && $this->option('path')) {
            return collect($this->option('path'))->map(function ($path) {
                return ! $this->usingRealPath()
                                ? $this->webApp->basePath().'/'.$path
                                : $path;
            })->all();
        }

        return array_merge(
            [$this->getMigrationPath()],
            $this->getModulesMigrationPaths(),
            $this->migrator->paths()
        );
    }

    /**
     * Determine if the given path(s) are pre-resolved "real" paths.
     *
     * @return bool
     */
    protected function usingRealPath()
    {
        return $this->input->hasOption('realpath') && $this->option('realpath');
    }

    /**
     * Get the path to the migration directory.
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        return $this->webApp->databasePath().DIRECTORY_SEPARATOR.'migrations';
    }

    /**
     * Retrieves the modules migration paths.
     *
     * @return array
     */
    protected function getModulesMigrationPaths()
    {
        $modules = get_modules_path();
        $migrationPath = config('path.migrations', 'database/migrations');

        return collect($modules)->map(function ($path) use ($migrationPath) {
            return "$path/$migrationPath";
        })->all();
    }

    /**
     * Retrieves the specified module's migration path.
     *
     * @param  array $module
     * @return string
     */
    protected function getModuleMigrationPath($module)
    {
        $realMigrationPath = config('path.migrations', 'database/migrations');
        foreach ($this->getModulesMigrationPaths() as $migrationPath) {
            $modulePath = preg_replace('/'.preg_quote($realMigrationPath, '/').'$/', '', $migrationPath);
            if (basename($modulePath) === $module) {
                $moduleMigrationPath = preg_replace('/'.preg_quote(base_path(), '/').'$/', '', $migrationPath);
                return $moduleMigrationPath;
            }
        }

        return $this->getMigrationPath();
    }
}
