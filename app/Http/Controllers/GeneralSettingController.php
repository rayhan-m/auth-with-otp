<?php

namespace App\Http\Controllers;

use App\User;
use App\MilkBuyer;
use App\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $data = GeneralSetting::where('active_status', '=', 1)->first();
        return view('admin.general_setting', compact('data'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|max:150',
            'site_title' => 'required',
            'location' => 'required|max:150',
            'email' => 'required',
            'phone' => 'required|max:15',
            'f_url' => 'required|max:50',
            't_url' => 'required|max:50',
            'g_url' => 'required|max:50',
            'i_url' => 'required|max:50',
            'copyright_text' => 'required|max:150',
        ]);
        $general_setting = GeneralSetting::find($request->id);
        $general_setting->site_name = $request->site_name;
        $general_setting->site_title = $request->site_title;
        $general_setting->location = $request->location;
        $general_setting->email = $request->email;
        $general_setting->phone = $request->phone;
        $general_setting->f_url = $request->f_url;
        $general_setting->t_url = $request->t_url;
        $general_setting->g_url = $request->g_url;
        $general_setting->i_url = $request->i_url;
        $general_setting->i_url = $request->i_url;
        $general_setting->copyright_text = $request->copyright_text;
        $general_setting->save();

        Toastr::success('Operation successful', 'Success');
        return redirect()->route('general_setting');
    }
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required',
        ]);
        $general_setting = GeneralSetting::find(1);
        $logo = "";
        if ($request->file('logo') != "") {
            $file = $request->file('logo');
            $logo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/backend/uploads/logo/', $logo);
            $logo = 'public/backend/uploads/logo/' . $logo;
            $general_setting->logo = $logo;
        }
        $general_setting->save();

        Toastr::success('Operation successful', 'Success');
        return redirect()->back();

    }
    public function updateFav(Request $request)
    {
        $request->validate([
            'fav' => 'required',
        ]);
        $general_setting = GeneralSetting::find(1);
        $fav = "";
        if ($request->file('fav') != "") {
            $file = $request->file('fav');
            $fav = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/backend/uploads/logo/', $fav);
            $fav = 'public/backend/uploads/logo/' . $fav;
            $general_setting->fav = $fav;
        }
        $general_setting->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }


    // Profile 
    public function Profile(){
        $profile=User::find(Auth::user()->id);
        return view('admin.profile',compact('profile'));
    }
    public function updateprofileImage(Request $request)
    {
        //  dd($request);
        //  return $request;

        $request->validate([
            'image' => 'required',
        ]);
        $profile = User::find(Auth::user()->id);
        $milk_buyer = MilkBuyer::where('user_id',Auth::user()->id)->first();
        // $file_path= $general_setting->logo;
        // unlink($file_path);
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/backend/uploads/staff/', $image);
            $image = 'public/backend/uploads/staff/' . $image;
            if (Auth::user()->role_id == 2) {
                $milk_buyer->image = $image;
                $milk_buyer->save();

            }
            $profile->image = $image;
        }
        $profile->save();

        Toastr::success('Operation successful', 'Success');
        return redirect()->back();

    }
    public function updateprofileInfo(Request $request)
    {
        // dd(Auth::user()->role_id);
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);
        $profile = User::find(Auth::user()->id);
        
        $profile->name=$request->name;
        $profile->email=$request->email;
        $profile->phone=$request->phone;
        if (Auth::user()->role_id == 2) {
            $profile->verification_status = 0;
            $profile->email_verified_at=null;
            $profile->verification_code=rand(100000, 999999);
        }
        $profile->save();
        if (Auth::user()->role_id == 2) {
            $otpController = new OTPVerificationController;
            $otpController->send_code($profile);
        }

        Toastr::success('Profile Updated Successfully', 'Success');
        return redirect()->back();
    }

    public function passwordUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:6|different:current_password',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
	    try {

            $user = Auth::user();
            if (Hash::check($request->current_password, $user->password)) {

                $user->password = Hash::make($request->new_password);
                $result = $user->save();

                if ($result) {
                    Toastr::success('Password Changed Successfully', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Current password not match!', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    
    
}