<?php

namespace Role\Support\Traits;

use Pluma\Support\Modules\Traits\ModulerTrait;

trait PermissionsFromModulesTrait
{
    use ModulerTrait;

    /**
     * The permissions files.
     *
     * @var array
     */
    protected $files;

    /**
     * The permissions array.
     *
     * @var array
     */
    protected $permissions;

    /**
     * Builds the permissions array from permissions files.
     *
     * @return void
     */
    public static function seeds()
    {
        $instance = (new static);
        $instance->files = $instance->getFileFromModules("config/permissions.php");
        $instance->permissions = $instance->getPermissionsFromFiles();

        return $instance->permissions;
    }

    /**
     * Retrieves the permissions array from the files.
     *
     * @return array
     */
    protected function getPermissionsFromFiles()
    {
        $permissions = [];

        foreach ($this->files as $file) {
            $permissions += require $file;
        }

        return $permissions ?? [];
    }

    /**
     * Retrieves the array of permission files.
     *
     * @return array
     */
    protected function getPermissionFiles()
    {
        $this->files = $this->getFileFromModules("config/permissions.php");
    }
}
