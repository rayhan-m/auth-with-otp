<?php

use App\GeneralSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_title');
            $table->string('location');
            $table->string('email');
            $table->string('phone');
            $table->string('f_url');
            $table->string('t_url');
            $table->string('g_url');
            $table->string('i_url');
            $table->string('copyright_text');
            $table->string('logo');
            $table->string('fav');
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });

        $general_setting = new GeneralSetting();
            $general_setting->site_name = 'Auth System ';
            $general_setting->site_title = "Auth With OTP";
            $general_setting->location = '1234 Hamill Avenue California, CA 02110';
            $general_setting->email = 'admin@gmail.com';
            $general_setting->phone = '01700000000';
            $general_setting->f_url = 'https://www.facebook.com/';
            $general_setting->t_url = 'https://twitter.com/';
            $general_setting->g_url = 'https://github.com/';
            $general_setting->i_url = 'https://www.instagram.com/';
            $general_setting->copyright_text = 'Copyright © 2020. All rights reserved to AUTH-SYSTEM';
            $general_setting->logo = 'public/backend/uploads/logo/logo.png';
            $general_setting->fav = 'public/backend/uploads/logo/fav.png';
            $general_setting->save(); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}