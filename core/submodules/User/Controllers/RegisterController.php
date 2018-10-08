<?php

namespace User\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Pluma\Controllers\Controller as Controller;
use Pluma\Support\Auth\Traits\RegistersUsers;
use User\Jobs\ActivateUser;
use User\Jobs\SendVerifyEmailNotification;
use User\Models\Activation;
use User\Models\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * The session key for when user successfully registered.
     *
     * @var string
     */
    protected $sessionKey = 'user';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms_and_conditions' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Array  $data
     * @return User
     */
    protected function create(Array $data)
    {
        $user = new User();
        $user->username = $data['email'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        $activation = new Activation();
        $activation->token = base64_encode($data['email']);
        $activation->user()->associate($user);
        $activation->save();

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('Theme::auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        dispatch(new SendVerifyEmailNotification($user, $user->activation->token));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Show the registered page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $token
     * @return mixed
     */
    public function showRegisteredPage(Request $request, $token)
    {
        $session = Session::get($this->sessionKey);
        if (isset($session->id)) {
            $user = User::find($session->id);
            if ($user->exists()) {
                return view("Theme::auth.registered");
            }
        }

        return abort(404);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $request->session()->put($this->sessionKey, $user);

        if ($request->ajax()) {
            return response()->json($user);
        }

        return redirect()->route("register.registered", $user->activation->token);
    }


    /**
     * Verify the user.
     *
     * @param  mixed $token
     * @param  int   $id
     * @return boolean
     */
    protected function verify($token, $id)
    {
        $user = User::find($id);

        if ($user && $user->exists() && ($user->activation->token === $token)) {

        }
    }
}
