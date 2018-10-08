<?php

namespace User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Pluma\Controllers\ApiController;
use Pluma\Support\Auth\Traits\AuthenticatesUsers;
use User\Models\User;
use User\Resources\User as UserResource;

class LoginApiController extends ApiController
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth.guest', ['except' => 'logout']);
    }

    /**
     * Authenticate the given resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $user = User::where('api_token', $request->input('api_token'));

        if (! $user->exists()) {
            return response()->json(['token' => null, 'user' => null]);
        }

        $user = $user->first();

        return response()->json(['token' => $user->token, 'user' => new UserResource($user)]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        $credentials = [
            'user' => $user = new UserResource($this->guard()->user()),
            'api_token' => $user->token,
            'remember_token' => $user->remember_token,
        ];

        return $this->authenticated($request, $user)
                ?: response()->json($credentials);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->has('remember')
        );
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            $this->username() => [Lang::get('auth.failed')]
        ], 422);
    }
}
