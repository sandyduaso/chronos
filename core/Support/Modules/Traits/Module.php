<?php

namespace Pluma\Support\Modules\Traits;

trait Module
{
    /**
     * Array modules.
     *
     * @var array
     */
    protected $modules;

    /**
     * Sets modules.
     *
     * @param array $modules
     */
    public function setModules(Array $modules = null)
    {
        $this->modules = is_null($modules) ? modules(true, null, false) : $modules;

        return $this;
    }

    /**
     * Gets modules value.
     *
     * @return array
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Require a file as array.
     *
     * @param  string $filepath
     * @param  array $modules
     * @return array
     */
    public function requireFileFromModules($filepath, $modules)
    {
        $items = [];
        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                // recurse '$module'
                $items += $this->requireFileFromModules($filepath, $module);

                $module = $name;
            }

            if (file_exists("$module/$filepath")) {
                $items += (array) require "$module/$filepath";
            }
        }

        return $items;
    }
}
