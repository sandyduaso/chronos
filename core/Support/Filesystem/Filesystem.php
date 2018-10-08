<?php

namespace Pluma\Support\Filesystem;

use Pluma\Support\Filesystem\FileAlreadyExists;

class Filesystem
{
    public function make($file, $content, $force = false, $quiet = false)
    {
        if (! $force && $this->exists($file) && ! $quiet) {
            throw new FileAlreadyExists;
        }

        $this->directory($file);

        return file_put_contents($file, $content);
    }

    public function get($file)
    {
        if (! $this->exists($file)) {
            throw new FileNotFound;
        }

        return file_get_contents($file);
    }

    public function put($file, $options)
    {
        $file = $this->get($file);

        foreach ($options as $key => $value) {
            $file = str_replace("$$key", $value, $file);
        }

        return $file;
    }

    public function directory($directory, $has_dirname = true)
    {
        $directory = $has_dirname ? dirname($directory) : $directory;

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    public function exists($file)
    {
        return file_exists($file);
    }
}
