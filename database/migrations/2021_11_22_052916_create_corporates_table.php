<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporates', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->default(0);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('contact')->nullable();
            $table->string('facebook_profile')->nullable();
            $table->string('twitter_profile')->nullable();
            $table->string('instagram_profile')->nullable();
            $table->bigInteger('mobile_app_id')->nullable();
            $table->bigInteger('app_emp_num')->nullable();
            $table->longText('emp_app_ids')->nullable();
            $table->text('image')->nullable();
            $table->text('doc')->nullable();
            $table->bigInteger('sports_emp_num')->default(0);
            $table->text('emp_name')->nullable();
            $table->text('spports_name')->nullable();
            $table->string('csr_name',150)->nullable();
            $table->string('csr_region',100)->nullable();
            $table->text('csr_detail')->nullable();
            $table->string('org_equipment_name',150)->nullable();
            $table->string('org_equipment_place',100)->nullable();
            $table->longText('eventname')->nullable();
            $table->longText('eventphoto')->nullable();
            $table->longText('eventdate')->nullable();
            $table->longText('noofparticipant')->nullable();
            $table->enum('status', ['0', '1', '2'])->default(0)->comment('0->Pending, 1->Approved, 2->Rejected');
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
        Schema::dropIfExists('corporates');
    }
}
