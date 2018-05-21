<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
            $toast['type'] = 'info';
            $toast['message'] = 'Activation Pending!';
            return redirect('/login')->with(['toast' => $toast]);
        }
        if($user->status == 2) {
            $toast['type'] = 'danger';
            $toast['message'] = 'Account Banned!';
            return redirect('/login')->with(['toast' => $toast]);
        }
    }
}
