<?php

use App\SmsSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sid');
            $table->string('token');
            $table->string('from');
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });
        $data = new SmsSetting();
        $data->sid = "ACf5b143e26ed4e9305a0986af1362efc5";
        $data->token = "3fb07720022fd888464dca14e000902a";
        $data->from = "+16088889398";
        $data->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_settings');
    }
}