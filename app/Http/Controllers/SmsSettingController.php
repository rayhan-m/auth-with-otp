<?php

namespace App\Http\Controllers;

use App\SmsSetting;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmsSettingController extends Controller
{
    public function smsSetting()
    {
        $data = SmsSetting::where('active_status', '=', 1)->first();
        return view('admin.sms_setting', compact('data'));
    }
    public function updateSmsSetting(Request $request)
    {
        $request->validate([
            'sid'         => "required",
            'token'        => "required",
            'from'        => "required",
        ]);


        if (
            $request->sid == ''
            || $request->token == ''
            || $request->from == ''
            ) {
            Toastr::error('All Field in Smtp Details Must Be filled Up', 'Failed');
            return redirect()->back();
        }
        
         try {

            $key1 = 'TWILIO_SID';
            $key2 = 'TWILIO_TOKEN';
            $key3 = 'TWILIO_FROM';

            $value1 = str_replace(" ","",$request->sid);
            $value2 = str_replace(" ","",$request->token);
            $value3 = str_replace(" ","",$request->from);

            $path                   = base_path() . "/.env";
            $TWILIO_SID          = env($key1);
            $TWILIO_TOKEN          = env($key2);
            $TWILIO_FROM        = env($key3);

            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    "$key1=" . $TWILIO_SID,
                    "$key1=" . $value1,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    "$key2=" . $TWILIO_TOKEN,
                    "$key2=" . $value2,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    "$key3=" . $TWILIO_FROM,
                    "$key3=" . $value3,
                    file_get_contents($path)
                ));
            }



                $data = SmsSetting::where('active_status', 1)->first();

                if (empty($data)) {
                    $data = new SmsSetting();
                }

                $data->sid = $request->sid;
                $data->token = $request->token;
                $data->from = $request->from;
                $data->save();

            if ($data) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed,'. $e->getMessage(), 'Failed');
            return redirect()->back();
        }
    }
}