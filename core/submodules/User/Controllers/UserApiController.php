<?php

namespace User\Controllers;

use Illuminate\Http\Request;
use Pluma\Controllers\ApiController;
use Pluma\Repository\RegistersRepository;
use Pluma\Repository\Repository;
use User\Repositories\UserRepository;
use User\Resources\User as UserResource;

class UserApiController extends ApiController
{
    use RegistersRepository;

    /**
     * Constructor for the User Api Controller
     * where we bind the UserRepository to the
     * variable $repository.
     *
     * @param \User\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct();

        $this->bind($repository);
    }

    /**
     * Retrieve list of resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function all(Request $request)
    {
        $users = $this
            ->repository()
            ->order($request->get('order'), $request->get('sort'))
            ->search($request->all())
            ->paginate($request->get('paginate'), $request->get('page'));

        return UserResource::collection($users);
    }

    /**
     * Retrieve the resource specified by the slug.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  id  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = $this->repository()->find($id);

        return new UserResource($user);
    }
}
