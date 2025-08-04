<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreedomrunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freedomruns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category')->unsigned();
            $table->string('name')->nullable();
            $table->string('eventimage1')->nullable();
            $table->string('eventimage2')->nullable();
            $table->string('eventstartdate')->nullable();
            $table->string('eventenddate')->nullable();
            $table->string('organiser_name')->nullable();
            $table->string('participantnum')->nullable();
            $table->string('kmrun')->nullable();
            $table->string('participant_names')->nullable();
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
        Schema::dropIfExists('freedomruns');
    }
}
