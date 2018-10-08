<?php

namespace Pluma\Support\Filesystem;

class FileAlreadyExists extends \Exception
{
    /**
     * The exception description.
     *
     * @var string
     */
    public $message = 'File already exists.';
}
