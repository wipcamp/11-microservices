<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('wip_id',110001);
            $table->string('fistname_th', 100)->nullable();
            $table->string('lastname_th', 100)->nullable();
            $table->string('fistname_en', 100)->nullable();
            $table->string('lastname_en', 100)->nullable();
            $table->string('telno', 100)->nullable();
            $table->string('nickname', 100)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('school_id', 100)->nullable();
            $table->string('school_name', 100)->nullable();
            $table->string('school_level', 100)->nullable();
            $table->string('school_major', 100)->nullable();
            $table->string('gpax', 100)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('allergic_food', 100)->nullable();
            $table->string('allergic_drug', 100)->nullable();
            $table->string('cangenital_disease', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->dateTime('dob')->nullable();
            $table->bigInteger('citizen_no')->default(13);
            $table->string('guardian_relative', 100)->nullable();
            $table->string('guardian_telno', 100)->nullable();
            $table->boolean('medical_approved')->nullable();
        });
        // DB::update("ALTER TABLE profiles AUTO_INCREMENT = 110001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
