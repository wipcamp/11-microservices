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

        Schema::create('flavors', function (Blueprint $table) {
            $table->increments('flavor_id');
            $table->integer('score');

        });

        Schema::create('flavorsScore', function (Blueprint $table) {
            $table->increments('score_id');
            $table->string('flavors_name');
            $table->integer('flavor_id')->unsigned();

            $table->foreign('flavor_id')->references('flavor_id')->on('flavors');
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->string('doc_id')->primary();
            $table->enum('status',['unsuccess','success']);
            $table->string('reason')->nullable();
            $table->string('transcript')->nullable();
            $table->string('confrim')->nullable();
            $table->string('receipt')->nullable();
            $table->enum('size', ['S', 'M','F','L','XL','2XL','3XL','4XL','พิเศษ'])->nullable();	
            $table->string('pick_location')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        
        Schema::create('campers', function (Blueprint $table) {
            $table->increments('camper_id');
            $table->integer('wip_id');
            $table->integer('bed_room');
            $table->integer('class_room');
            $table->string('wifi_pass');
            $table->integer('flavor_id')->unsigned();
            $table->string('doc_id');

            $table->foreign('flavor_id')->references('flavor_id')->on('flavors');
            $table->foreign('doc_id')->references('doc_id')->on('documents');
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
        Schema::dropIfExists('flavors');
        Schema::dropIfExists('flavorsScore');
        Schema::dropIfExists('campers');
        Schema::dropIfExists('documents');
    }
}
