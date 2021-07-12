<?php

namespace App\Http\Controllers;

use App\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OTPVerificationController extends Controller
{
    public function verification(Request $request)
    {

        try {
            if (Auth::check() && Auth::user()->email_verified_at == null) {
                return view('verify.user_verification');
            } else {
                flash('You have already verified your number')->warning();
                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            flash(translate('Ops! Something went wrong!'))->error();
            return redirect()->back();
        }
    }
    
    public function send_code($user)
    {
        try {
            $message  = $user->verification_code . ' is your verification code';
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
            
            $client = new Client($account_sid, $auth_token);
            $client->messages->create('+88'.$user->phone, [
                'from' => $twilio_number, 
                'body' => $message]);
                
            return redirect()->route('verification');

        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return redirect()->back()->with('error','Ops! Something went wrong!');
        }
    }

    public function verify_phone(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|min:6|numeric'
        ]);

        DB::beginTransaction();
        try {
            $user = Auth::user();
            if ($user->verification_code == $request->verification_code) {

                // $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($user->updated_at);
                
                // if(\Config::get('sookh.otp_validity') < $diff){
                //     return back()->with('error','Your OTP has been expired.');
                // }

                $user->email_verified_at = date('Y-m-d h:m:s');
                $user->verification_status = 1;
                $user->save();

                DB::commit();
                return redirect()->route('customer.dashboard')->with('success','Your phone number has been verified successfully');
            } else {
                DB::rollBack();
                return back()->with('error','Your OTP numer is invalid!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th->getMessage());
            flash(translate('Ops! Something went wrong!'))->error();
            return redirect()->back();
        }
    }

    public function sendResetCode(Request $request){
        $user = User::where('phone', $request->phone)->first();
        if ($user != null) {
            $user->verification_code = rand(100000,999999);
            $user->save();
            $otpController = new OTPVerificationController;
            $otpController->send_code($user);

            return view('auth.passwords.reset');
        }
        else {
            return back()->with('error','No account exists with this phone number');
        }
    }

    public function reset_password_with_code(Request $request)
    {
        DB::beginTransaction();
        try {
            if (($user = User::where('phone', $request->phone)->where('verification_code', $request->code)->first()) != null) {
                if ($request->password == $request->password_confirmation) {
                    $user->password = Hash::make($request->password);
                    $user->email_verified_at = date('Y-m-d h:m:s');
                    $user->verification_status = 1;
                    $user->save();
                    auth()->login($user, true);
                    DB::commit();
                    Toastr::success('Password updated successfully', 'Success');
                    return redirect()->route('customer.dashboard');
                } else {
                    DB::rollBack();
                    return back()->with('error', 'Passwords didnt match');
                }
            } else {
                DB::rollBack();
                return back()->with('error', 'Verification code mismatch');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th->getMessage());
            return back()->with('error', 'Ops! Something went wrong');
        }
    }
}