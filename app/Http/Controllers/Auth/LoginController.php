<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function login(Request $request)
    {
        // Check validation
        $this->validate($request, [
            'phone' => 'required|regex:/[0-9]{10}/|digits:11',            
        ]);

        // Get user record
        $user = User::where('phone', $request->get('phone'))->first();

        // Check Condition Mobile No. Found or Not
        if($request->get('phone') != $user->phone) {
            \Session::put('errors', 'Your mobile number not match in our system..!!');
            return back();
        }        
        
        // Set Auth Details
        \Auth::login($user);

        if (Auth::check() && Auth::user()->role->id==2) {
            return redirect()->route('customer.dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
        
        // Redirect home page
    }

}