<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgRewardsCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_rewards_cat', function (Blueprint $table) {
            $table->id();
            $table->string('award_group_type_name')->nullable();
            $table->enum('status', ['1', '0'])->default(1)->comment('0->Pending, 1->Approved');
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
        Schema::dropIfExists('org_rewards_cat');
    }
}
