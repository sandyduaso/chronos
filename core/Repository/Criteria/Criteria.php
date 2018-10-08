<?php

namespace Pluma\Repository\Criteria;

use Pluma\Repository\Contracts\RepositoryInterface;

abstract class Criteria
{
    public abstract function apply($model, RepositoryInterface $repository);
}
