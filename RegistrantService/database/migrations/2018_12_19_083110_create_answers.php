<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswers extends Migration
{

    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('ans_id');
            $table->integer('question_id')->unsigned();
            $table->integer('wip_id')->unsigned();
            $table->text('ans_content')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at') ->default(
                DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
            );
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('wip_id')->references('wip_id')->on('profiles');

        });

    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
