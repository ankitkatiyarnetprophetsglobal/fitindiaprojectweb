<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_rewards', function (Blueprint $table) {
            $table->id();
            $table->integer('award_group_type_id')->default(0);
            $table->string(' award_group_type_name')->nullable();
            $table->integer('award_type_id')->default(0);
            $table->string('award_type_name')->nullable();
            $table->bigInteger('awardee_id')->default(0);
            $table->string('awardee_name')->nullable();
            $table->text('awardee_image')->nullable();
            $table->enum('status', ['0', '1'])->default(0)->comment('0->Pending, 1->Approved');
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
        Schema::dropIfExists('organization_rewards');
    }
}
