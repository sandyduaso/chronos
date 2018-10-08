<?php

namespace Pluma\Support\Auth\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Pluma\Support\Auth\User;

trait CreateUser
{
    /**
     * Creates a root/superadmin user.
     *
     * @return boolean
     */
    public function createRootUser(Request $request)
    {
        $user = new User();
        $user->firstname = "Foo";
        $user->lastname = "Bar";
        $user->username = $request->input('email');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return true;
    }
}
