<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Flavors', function (Blueprint $table) {
            $table->increments('flavor_id');
            $table->Integer('score');

        });

        Schema::create('FlavorsScore', function (Blueprint $table) {
            $table->increments('score_id');
            $table->string('flavors_name');
            $table->integer('flavor_id')->unsigned();

            $table->foreign('flavor_id')->references('flavor_id')->on('Flavors');
        });

        Schema::create('Documents', function (Blueprint $table) {
            $table->increments('doc_id');
            $table->string('status');
            $table->string('reson');
            $table->string('doc_path');
            $table->enum('doc_type', ['TranScript', 'Permission','Receipt']);	
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        
        Schema::create('Campers', function (Blueprint $table) {
            $table->increments('camper_id');
            $table->Integer('wip_id');
            $table->Integer('bed_room');
            $table->Integer('class_room');
            $table->string('wifi_pass');
            $table->string('pick_location');
            $table->enum('size', ['S', 'M','F','L','XL','XXL']);	
            $table->integer('flavor_id')->unsigned();
            $table->integer('doc_id')->unsigned();

            $table->foreign('flavor_id')->references('flavor_id')->on('Flavors');
            $table->foreign('doc_id')->references('doc_id')->on('Documents');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Flavors');
        Schema::dropIfExists('FlavorsScore');
        Schema::dropIfExists('Campers');
        Schema::dropIfExists('Documents');
    }
}
