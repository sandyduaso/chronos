<?php

namespace User\Controllers;

use Frontier\Controllers\GeneralController;
use User\Controllers\Resources\CanUploadToStorageTrait;
use User\Controllers\Resources\UserResourceAdminTrait;
use User\Controllers\Resources\UserResourceApiTrait;
use User\Controllers\Resources\UserResourceExportTrait;
use User\Controllers\Resources\UserResourceSoftDeleteTrait;
use User\Models\User;
use User\Repositories\UserRepository;

class UserController extends GeneralController
{
    use UserResourceAdminTrait,
        UserResourceApiTrait,
        UserResourceExportTrait,
        UserResourceSoftDeleteTrait;

    /**
     * Inject the resource model to the repository instance.
     *
     * @param \Pluma\Models\Model $model
     */
    public function __construct(User $model)
    {
        $this->repository = new UserRepository($model);

        parent::__construct();
    }
}
