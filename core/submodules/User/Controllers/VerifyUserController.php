<?php

namespace User\Controllers;

use Illuminate\Http\Request;
use Pluma\Controllers\Controller as Controller;
use User\Models\User;

class VerifyUserController extends Controller
{
    /**
     * Verify the account.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @param  string $token
     * @return Illuminate\Http\Response
     */
    public function verify(Request $request, $id, $token)
    {
        $user = User::findOrFail($id);
        if ($user->activation->token == $token) {
            $user->activation->activated = 1;
            $user->save();
        }

        return redirect()->route('dashboard');
    }
}
