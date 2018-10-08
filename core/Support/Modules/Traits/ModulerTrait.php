<?php

namespace Pluma\Support\Modules\Traits;

use Illuminate\Support\Facades\File;

trait ModulerTrait
{
    /**
     * The modules array
     *
     * @var Array
     */
    public $modules;

    /**
     * Alias for getModules method.
     *
     * @return array
     */
    public function modules()
    {
        return empty($this->getModules())
            ? $this->getModulesFromFiles()
            : $this->getModules();
    }

    /**
     * Retrieves the realpath of the array of modules.
     *
     * @return array
     */
    public function modulePaths()
    {
        return $this->getModulesFromFiles(false);
    }

    /**
     * Retrieves the modules array.
     *
     * @return array
     */
    protected function getModules()
    {
        return $this->modules;
    }

    /**
     * Sets the modules array.
     *
     * @param array $modules
     * @return $this
     */
    public function setModules(array $modules = null)
    {
        $this->modules = $modules;

        return $this;
    }

    /**
     * Retrieves the modules present in core and modules folder
     * if not found in cache.
     *
     * @param  Boolean $isBasenameOnly
     * @return array
     */
    public function getModulesFromFiles($isBasenameOnly = true)
    {
        return cache()->get('modules', get_modules_path($isBasenameOnly));
    }

    /**
     * Gets the full path of the specified module.
     *
     * @param  Array $module
     * @param  String $default
     * @return string
     */
    public function getModulePath($module, $default = '')
    {
        foreach ($this->getModulesFromFiles(false) as $modulePath) {
            if ($module === basename($modulePath)) {
                return $modulePath;
            }
        }

        return $default;
    }

    /**
     * Retrieves the specified file from all modules.
     *
     * @param  string $file
     * @return array
     */
    public function getFileFromModules($file)
    {
        // return cache()->remember("cached::$file", 120, function () use ($file) {
        // });
        return collect($this->modulePaths())
            ->filter(function ($path) use ($file) {
                if (file_exists("$path/$file")) {
                    return "$path/$file";
                }
            })
            ->map(function ($path) use ($file) {
                return "$path/$file";
            })
            ->values()
            ->all();
    }

    /**
     * Retrieves the files from regex, looking in all module paths.
     *
     * @param  string $path
     * @return array
     */
    public function getFilesFromModules($path)
    {
        foreach ($this->modulePaths() as $modulePath) {
            if (file_exists($modulePath.'/'.$path) || is_dir($modulePath.'/'.$path)) {
                $files[] = File::allFiles($modulePath.'/'.$path);
            }
        }

        return $files ?? [];
    }

    /**
     * Determine if the module name exists.
     *
     * @param string $module
     * @return boolean
     */
    public function isModule($module)
    {
        return in_array($module, $this->modules());
    }
}
