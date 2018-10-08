<?php

namespace Tests\Support\Test;

use Repository\Factory;

trait WithRepository
{
    /**
     * The repository instance.
     *
     * @var dynamic
     */
    protected $repository;

    /**
     * Setup up the Repository instance.
     *
     * @return void
     */
    protected function setUpRepository()
    {
        //
    }

    /**
     * Get the default Repository instance for a given a repository.
     *
     * @param  string  $repository
     * @param  string  $model
     * @return Repository
     */
    protected function repository($repository, $model)
    {
        return new $repository(new $model);
    }
}
