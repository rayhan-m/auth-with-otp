<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin','middleware'=>['auth','admin']], function () {
    Route::get('dashboard', 'BackEndController@Dashboard')->name('admin.dashboard');

    Route::get('sms-setting', 'SmsSettingController@smsSetting')->name('smsSetting');
    Route::post('update-sms-setting', 'SmsSettingController@updateSmsSetting')->name('updateSmsSetting');

    Route::get('general-setting', 'GeneralSettingController@index')->name('general_setting');
    Route::POST('update-general-setting', 'GeneralSettingController@update')->name('update-general-setting');
    Route::POST('update-logo', 'GeneralSettingController@updateLogo')->name('update-logo');
    Route::POST('update-fav', 'GeneralSettingController@updateFav')->name('update-fav');

});
Route::group(['prefix' => 'customer','middleware'=>['auth','userVerified','customer']], function () {
    Route::get('dashboard', 'BackEndController@Dashboard')->name('customer.dashboard');
    Route::get('profile', 'GeneralSettingController@Profile');
});

Route::group(['middleware'=>['auth','userVerified']], function () {
    // Profile 
    Route::get('profile', 'GeneralSettingController@Profile');
    Route::POST('update-profile-image', 'GeneralSettingController@updateprofileImage')->name('update-profile-image');
    Route::POST('update-profile-info', 'GeneralSettingController@updateprofileInfo')->name('update-profile-info');
    Route::post('change-pass', 'GeneralSettingController@passwordUpdate');
    
});
    Route::get('/verification', 'OTPVerificationController@verification')->name('verification');
    Route::post('/verification', 'OTPVerificationController@verify_phone')->name('verification.submit');
    Route::get('/verification/phone/code/resend', 'OTPVerificationController@resend_verificcation_code')->name('verification.phone.resend');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::any('password/reset/phone', 'OTPVerificationController@sendResetCode')->name('password.phone');
    Route::post('/password/reset/phone/submit', 'OTPVerificationController@reset_password_with_code')->name('password.update');