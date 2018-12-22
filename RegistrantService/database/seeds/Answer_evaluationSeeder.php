<?php

use Illuminate\Database\Seeder;

class Answer_evaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answer_evaluations')->insert([
            'answer_id' => 1,
            'checker_wip_id' =>119999,
            'question_id' => 1,
            'score_category'=>'intelligent_weight',
            'score'=> 100,
        ]);
    }
}
