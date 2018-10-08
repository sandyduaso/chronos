<?php

namespace Pluma\Repository;

use Pluma\Repository\Repository;

trait RegistersRepository
{
    /**
     * The repository instance.
     *
     * @var \Pluma\Support\Repository\Repository
     */
    protected $repository;

    /**
     * Bind the repository.
     *
     * @param \Pluma\Repository\Repository $repository
     * @return void
     */
    public function bind(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retrieves the repository instance.
     *
     * @return \Pluma\Repository\Repository
     */
    public function repository()
    {
        return $this->repository;
    }
}
