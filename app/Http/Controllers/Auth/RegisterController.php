<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

// TAMBAHAN
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
// MAIL
use App\Mail\userRegistered;
use Illuminate\Support\Facades\Mail;

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
     * Where to redirect users after login / registration.
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
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            // 'password' => 'required|min:6|confirmed',
            'password' => 'required|min:6',
        ]);
    }

    /** OVERIDE laravel/framework/src/illuminate/foundation/auth/access/RegistersUsers
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect('/login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'ver_token' => str_random(20),
            'verif' => 0,
        ]);
        //mengirim email
        Mail::to($user->email)->send(new userRegistered($user));
    }
    protected function verify_register($ver_token, $id)
    {
        $customers = User::find($id);
        //Uji Token Verifikasi
        if($customers->ver_token != $ver_token){
            return redirect('login')->with('warning','Verifikasi Email Tidak Cocok');
        }
        //Status User Jadi 1
        $customers->stat = 1;
        $customers->save();
        //Login
        $this->guard()->login($customers);
        return redirect($id . "/userdetail");
    }
}
