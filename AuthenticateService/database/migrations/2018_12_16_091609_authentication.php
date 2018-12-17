<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Authentication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credential', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider_id');
            $table->enum('provider_name', ['facebook', 'line']);
            $table->enum('role', ['itim_applicant', 'itim_passing']);
            $table->unsignedInteger('wip_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credential');
    }
}
