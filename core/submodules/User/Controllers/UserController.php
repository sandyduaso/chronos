<?php

namespace User\Controllers;

use Frontier\Controllers\GeneralController;
use User\Models\User;
use User\Repositories\UserRepository;

class UserController extends GeneralController
{
    use Resources\UserResourceAdminTrait,
        Resources\UserResourceApiTrait,
        Resources\UserResourceExportTrait,
        Resources\AvatarResourceUploadTrait,
        Resources\UserResourceSoftDeleteTrait;

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
