<?php

namespace User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Pluma\Controllers\Controller;
use Pluma\Support\Auth\Password\Traits\SendsPasswordResetEmailsTrait;
use User\Requests\EmailRequest;

class ForgotPasswordController extends Controller
{
   /**
    *---------------------------------------------------------------------------
    * Password Reset Controller
    *---------------------------------------------------------------------------
    *
    * This controller is responsible for handling password reset emails and
    * includes a trait which assists in sending these notifications from
    * your application to your users.
    *
    */

    use SendsPasswordResetEmailsTrait;

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
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('Theme::passwords.forgot');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \User\Requests\EmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(EmailRequest $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email'), $this->resetNotifier()
        );

        if ($response === Password::RESET_LINK_SENT) {
            return view("Theme::passwords.sent")->with('status', trans($response));
        }

        // If an error was returned by the password broker, we will get this message
        // translated so we can notify a user of the problem. We'll redirect back
        // to where the users came from so they can attempt this process again.
        // dd($response);
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    /**
     * Show the email sent page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sent(Request $request)
    {
        return view("Theme::passwords.sent");
    }
}
