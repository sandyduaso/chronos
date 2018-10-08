<?php

namespace Profile\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Profile\Models\Profile;
use Profile\Requests\CredentialRequest;
use User\Models\User;

class CredentialController extends AdminController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $handle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $handle)
    {
        $resource = User::whereUsername(ltrim($handle, '@'))->firstOrFail();

        return view("Theme::profiles.credentials")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Profile\Requests\CredentialRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CredentialRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->input('username')) {
            $user->username = $request->input('username');
        }

        $user->save();

        return redirect()->route('credentials.edit', $user->handlename);
    }
}
