<?php

namespace Profile\Controllers;

use Catalogue\Models\Catalogue;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Profile\Models\User;
use Profile\Requests\ProfileRequest;
use Profile\Support\Traits\ProfileResourcePublicTrait;
use User\Requests\UserRequest;

class ProfileController extends GeneralController
{
    use ProfileResourcePublicTrait;

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string  $handle
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $handle)
    {
        $resource = User::whereUsername(ltrim($handle, '@'))->firstOrFail();

        return view("Theme::profiles.show")->with(compact('resource'));
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
