<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\MilkBuyer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\OTPVerificationController;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         if (Auth::check() && Auth::user()->role->id==2) {
            $this->redirectTo=route('customer.dashboard');
        } else {
            $this->redirectTo=route('admin.dashboard');
        }
        $this->middleware('guest')->except('logout');
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => hash('sha256', $data['password']),
            // 'password' => Hash::make($data['password']),
            'verification_code' => rand(100000, 999999)
        ]);

        $milk_buyer = new MilkBuyer();
        $milk_buyer->name = $data['name'];
        $milk_buyer->phone = $data['phone'];
        $milk_buyer->user_id = $user->id;
        $milk_buyer->save();

        $otpController = new OTPVerificationController;
        $otpController->send_code($user);

        return $user;

    }
}