<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\General;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        $this->middleware('language');
    }

    public function showRegistrationForm()
    {
        $gnl = General::first();
        if($gnl->reg==1)
        {
            return view('auth.register');
        }
        else
        {
            return redirect()->route('login')->with('alert', 'Registration Closed Now');
        }
       
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
            'username' => 'required|string|min:4|max:255|unique:users|alpha_dash',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required|string',
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
        $gnl = General::first();

        if($gnl->reg==1)
        {
            if(isset($data['refer']))
            {
                $refer = User::where('username', $data['refer'])->first();
                
                $refuser = $refer->id;

                $msg =  'Referal Registered Successfully';
                send_email($refer->email, $refer->username, 'Referal Registration', $msg);
                send_sms($refer->mobile, $msg);
            }
            else
            {
                $refuser = "0";
            }
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'username' => $data['username'],
                'country' => '',
                'city' => '',
                'mobile' => $data['mobile'],
                'refer' => $refuser,
                'emailv' =>  $gnl->emailver,
                'smsv' =>  $gnl->smsver,
            ]);
        }
        else
        {
            return redirect()->route('login')->with('alert', 'Registration Closed Now');
        }
    }
}
