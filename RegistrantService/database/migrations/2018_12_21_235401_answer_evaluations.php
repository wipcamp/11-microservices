<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnswerEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_evaluations', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->integer('answer_id')->unsigned();
            $table->integer('checker_wip_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->enum('score_category', ['intelligent_weight', 'communication_weight','creative_weight']);
            $table->integer('score')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('answer_id')->references('ans_id')->on('answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_evaluations');
    }
}
