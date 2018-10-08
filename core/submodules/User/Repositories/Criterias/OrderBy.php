<?php

namespace User\Repositories\Criterias;

use Pluma\Repository\Contracts\RepositoryInterface;
use Pluma\Repository\Criteria\Criteria;
use User\Models\User;

class OrderBy extends Criteria
{
    /**
     * Apply the orderBy on the model.
     *
     * @param \User\Models\User           $model
     * @param \User\Repositories\UserRepository $repository
     * @return \Pluma\Models\Model
     */
    public function apply($model, RepositoryInterface $repository, ...$params)
    {
        return $model->orderBy('id');
    }
}
