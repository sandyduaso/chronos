<?php

namespace Profile\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Profile\Models\Profile;
use Profile\Requests\CredentialRequest;
use User\Models\User;

class EmailController extends AdminController
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

        return view("Theme::profiles.emails")->with(compact('resource'));
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
        foreach ($request->input('settings') as $key => $value) {
            $user->settings()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        $user->save();

        return redirect()->route('profile.emails.edit', $user->handlename);
    }
}
