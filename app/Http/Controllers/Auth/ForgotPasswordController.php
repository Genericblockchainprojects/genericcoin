<?php

namespace App\Http\Controllers\Auth;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:users,email'],[
            'email.required' => 'Email is required.',
            'email.email' => 'Enter valid email.',
            'email.exists' => 'Email does not exists.'
        ]);
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        $request->session()->flash('alert-success', 'Password reset link sent on your registerd email. Please check..');
        return redirect()->back();
    }
}
