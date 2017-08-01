<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Log;

class AuthController extends Controller
{
    private $redirectPath = '/';
    private $loginPath = '/';
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'birthday' => 'required',
            'nickname' => 'required',
            //'sex' => 'required',
            'height' => 'required|integer',
            'weight' => 'required|integer',
            'password' => 'required|confirmed|min:6',
            'agree' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'nickname' => $data['nickname'],
            //'sex' => $data['sex'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'authority' => $data['authority'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
