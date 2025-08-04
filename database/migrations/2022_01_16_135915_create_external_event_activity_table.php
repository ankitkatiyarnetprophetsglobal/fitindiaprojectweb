<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalEventActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_event_activity', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('extevent_reg_id')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->string('event_activity_date',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_event_activity');
    }
}
