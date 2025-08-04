<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_quiz', function (Blueprint $table) {
            $table->id();
            $table->text('quest')->nullable();
            $table->string('opt1',500)->nullable();
            $table->string('opt2',500)->nullable();
            $table->string('opt3',500)->nullable();
            $table->string('opt4',500)->nullable();
            $table->string('ans',500)->nullable();
            $table->string('episode',250)->nullable();
            $table->string('episode_date',20)->nullable();
            $table->enum('status', ['0', '1'])->default(0)->comment('0->Inactive, 1->Active');
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
        Schema::dropIfExists('episode_quiz');
    }
}
