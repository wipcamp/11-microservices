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
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('wip_id');
            $table->string('firstname_th', 100)->nullable();
            $table->string('lastname_th', 100)->nullable();
            $table->string('firstname_en', 100)->nullable();
            $table->string('lastname_en', 100)->nullable();
            $table->string('telno', 10)->nullable();
            $table->string('nickname', 100)->nullable();
            $table->enum('gender', ['ชาย', 'หญิง'])->nullable();
            $table->string('school_id', 3)->nullable();
            $table->string('school_name', 100)->nullable();
            $table->string('school_level',15)->nullable();
            $table->string('school_major', 100)->nullable();
            $table->string('gpax', 4)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('allergic_food', 100)->nullable();
            $table->string('allergic_drug', 100)->nullable();
            $table->string('cangenital_disease', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('dob')->nullable();
            $table->string('citizen_no',13)->nullable();
            $table->string('guardian_relative', 20)->nullable();
            $table->string('guardian_telno', 10)->nullable();
            $table->boolean('medical_approved',false)->nullable();
            $table->boolean('confirm_register',false)->nullable();
            $table->boolean('is_call',false)->nullable();
            $table->text('note')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        DB::statement("ALTER TABLE profiles AUTO_INCREMENT = 110001;");
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
