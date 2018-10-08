<?php

namespace User\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Pluma\Controllers\Controller;
use Pluma\Support\Auth\Password\Traits\ResetsPasswordsTrait;

class ResetPasswordController extends Controller
{
    /**
     *--------------------------------------------------------------------------
     * Password Reset Controller
     *--------------------------------------------------------------------------
     *
     * This controller is responsible for handling password reset requests
     * and uses a simple trait to include this behavior. You're free to
     * explore this trait and override any methods you wish to tweak.
     *
     */

    use ResetsPasswordsTrait;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'login.show';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * The redirect route.
     *
     * @return string
     */
    public function redirectTo()
    {
        return route($this->redirectTo);
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token)
    {
        // $this->tokenValidation($request);

        return view('Theme::passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // public function tokenValidation($request)
    // {
    //     $reset = DB::table(config('auth.passwords.users.table', 'password_resets'))
    //         ->where('email', $request->email)
    //         ->first();
    //
    //     if (! $reset || ! Hash::check($request->token, $reset->token)) {
    //         return abort(404);
    //     }
    //
    //     if (Carbon::parse($reset->created_at)
    //             ->addSeconds(config('auth.passwords.users.expire', 60) * 60)
    //             ->isPast()) {
    //         return abort(404);
    //     }
    //
    //     return true;
    // }
}
