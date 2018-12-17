<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestions extends Migration
{

    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->text('content');
            $table->integer('intelligent_weight');
            $table->integer('communication_weight');
            $table->integer('creative_weight');
        });


    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}


