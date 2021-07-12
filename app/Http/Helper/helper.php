<?php

use App\User;
use App\GeneralSetting;

if (!function_exists('getSetting')) {
    function getSetting()
    {
        $getSetting = GeneralSetting::findorfail(1);
        return $getSetting;
    }
}
if (!function_exists('getProfilePic')) {
    function getProfilePic()
    {
        $user = User::findorfail(Auth::user()->id);
        return $user;
    }
}