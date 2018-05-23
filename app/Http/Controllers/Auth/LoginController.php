<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->status != 1) {
            $this->guard()->logout();
            $request->session()->invalidate();
        }
        if($user->status == 0) {
            Mail::to($user->email)->send(new VerifyMail($user));
            $toast['type'] = 'info';
            $toast['message'] = 'Email verification pending! Check Inbox';
            return redirect('/login')->with(['toast' => $toast]);
        }
        if($user->status == 2) {
            $toast['type'] = 'danger';
            $toast['message'] = 'Account Banned!';
            return redirect('/login')->with(['toast' => $toast]);
        }
    }
}
