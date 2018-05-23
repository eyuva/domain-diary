<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyMail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Vinkla\Hashids\Facades\Hashids;

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
    protected $redirectTo = '/home';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
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
            $toast['message'] = 'You\'re banned!';
            return redirect('/login')->with(['toast' => $toast]);
        }
    }
    protected function verify(Request $request, $token)
    {
        try{
            $user_id = Hashids::decode($token)[0];
            $time = Hashids::decode($token)[1];
//            Time based restrictions can be done here
            $user = User::find($user_id);
            if( $user->status == 0){
                $user->status = 1;
                $user->save();
                $toast['type'] = 'info';
                $toast['message'] = 'Email verified!';
            }else{
                $toast['type'] = 'info';
                $toast['message'] = 'Email verification already done!';
            }
        }
        catch (\Exception $e){
            $toast['type'] = 'danger';
            $toast['message'] = 'Some error occurred';
        }
        return redirect('/login')->with(['toast' => $toast]);
    }
}
