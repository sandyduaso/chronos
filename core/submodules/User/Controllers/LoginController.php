<?php

namespace User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Pluma\Controllers\Controller;
use Pluma\Support\Auth\Traits\AuthenticatesUsers;
use User\Resources\User as UserResource;

class LoginController extends Controller
{
    /**
     *--------------------------------------------------------------------------
     * Login Controller
     *--------------------------------------------------------------------------
     *
     * This controller handles authenticating users for the application and
     * redirecting them to your home screen. The controller uses a trait
     * to conveniently provide its functionality to your applications.
     *
     */

    use AuthenticatesUsers;

    /**
     * Redirect path upon successful login.
     *
     * @var string
     */
    protected $redirectPath = 'dashboard';

    /**
     * Where to redirect users on failed login.
     *
     * @var string
     */
    protected $redirectTo = 'login';

    /**
     * Redirect path upon successful logout.
     *
     * @var string
     */
    protected $logoutPath = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.guest', ['except' => 'logout']);

        $this->logoutPath = config('path.redirect_after_logout', $this->logoutPath);

        $this->redirectPath = route(config('path.dashboard', $this->redirectPath));

        $this->redirectTo = config('path.login', $this->redirectTo);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('Theme::auth.login');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return $this->redirectPath;
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($this->logoutPath);
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
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        if ($this->guard()->attempt(
            ['email' => $request->username, 'password' => $request->password], $request->remember
        )) {
            return true;
        }

        if ($this->guard()->attempt(
            ['username' => $request->username, 'password' => $request->password], $request->remember
        )) {
            return true;
        }

        if ($this->guard()->attempt(
            [$this->username() => $request->username, 'password' => $request->password], $request->remember
        )) {
            return true;
        }

        return false;
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($request->ajax()) {
            return response()->json(['token' => $user->token]);
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                $this->username() => [Lang::get('auth.failed')],
            ], 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
    }
}
