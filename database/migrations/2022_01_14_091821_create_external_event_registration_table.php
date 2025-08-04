<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalEventRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('external_event_registration', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('external_evt_id')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->string('registration_type',50)->nullable();
            $table->string('org_name',500)->nullable();
            $table->integer('num_of_participant')->default(0);
            $table->integer('state_id')->default(0);
            $table->string('state_name',255)->nullable();
            $table->integer('district_id')->default(0);
            $table->string('district_name',255)->nullable();
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
        Schema::dropIfExists('external_event_registration');
    }
}
