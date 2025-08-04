<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGramPanchayatAmbassadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gram_panchayat_ambassador', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('age')->default(0);
            $table->string('gender',10)->nullable();
            $table->string('state_name')->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->string('district_name')->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->string('block_name')->nullable();
            $table->bigInteger('block_id')->unsigned()->nullable();
            $table->string('gram_panchayat_name')->nullable();
            $table->string('document_file')->nullable();
            $table->string('physical_activity',10)->nullable();
            $table->text('additional_person_info')->nullable();
            $table->text('fitness_event')->nullable();
			$table->text('physical_fitness')->nullable();
			$table->midiumText('yclubeventcommits')->nullable();
			$table->mediumText('eventname')->nullable();
			$table->mediumText('noofparticipant')->nullable();
			$table->mediumText('eventphoto')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('gram_panchayat_ambassador');
    }
}
