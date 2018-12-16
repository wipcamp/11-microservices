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
        Schema::create('authentication', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id');
            $table->enum('prodier_name', ['facebook', 'line'])->nullable()->default(['facebook', 'line']);
            $table->enum('role', ['itim_applicant', 'itim_passing'])->nullable()->default(['itim_applicant', 'itim_passing']);
            $table->unsignedInteger('wip_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authentication');
    }
}
