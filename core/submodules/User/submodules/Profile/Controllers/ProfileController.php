<?php

namespace Profile\Controllers;

use Frontier\Controllers\GeneralController;
use User\Models\User;
use User\Repositories\UserRepository;

class ProfileController extends GeneralController
{
    use Resources\ProfileResourceAdminTrait;

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Profile\Requests\ProfileRequest $request
     * @param  string  $handle
     * @return Illuminate\Http\Response
     */
    public function edit(ProfileRequest $request, $handle)
    {
        $resource = User::whereUsername(ltrim($handle, '@'))->firstOrFail();
        $avatars = User::avatars();

        return view("Theme::profiles.edit")->with(compact('resource', 'avatars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \User\Requests\UserRequest  $request
     * @param  string  $handle
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $handle)
    {
        $user = User::whereUsername($handle)->firstOrFail();
        $user->firstname = $request->input('firstname');
        $user->avatar = $request->input('avatar');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->save();

        foreach ($request->input('details') as $key => $value) {
            $user->details()->updateOrCreate(['key' => $key], ['key' => $key, 'value' => $value]);
        }

        return redirect()->route('profile.show', $user->handlename);
    }
}
