<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreedomRunPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freedom_run_partners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('org_name')->nullable();
            $table->string('event_name')->nullable();
            $table->string('email_id')->nullable();
            $table->bigInteger('contact')->nullable();
            $table->string('from_date',30)->nullable();
            $table->string('to_date',30)->nullable();
            $table->string('photo')->nullable();
            $table->string('website_link')->nullable();
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
        Schema::dropIfExists('freedom_run_partners');
    }
}
