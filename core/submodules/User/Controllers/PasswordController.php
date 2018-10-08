<?php

namespace User\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use User\Models\User;
use User\Requests\PasswordChangeRequest;

class PasswordController extends AdminController
{
    /**
     * Display the form to change password.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getChangeForm(Request $request, $id)
    {
        $resource = User::findOrFail($id);

        return view("Theme::passwords.change")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \User\Requests\PasswordChangeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change(PasswordChangeRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return back();
    }
}
