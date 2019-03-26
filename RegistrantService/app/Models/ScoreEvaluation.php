<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreEvaluation extends Model
{
    public $timestamps = false;
    protected $table = 'score_evaluations';
    protected $fillable = [
        'wip_id', 
        'mean_cat_int',
        'mean_cat_com',
        'mean_cat_crt',
        'mean_score_question_1',
        'mean_score_question_2',
        'mean_score_question_3',
        'mean_score_question_4',
        'mean_score_question_5',
        'sum_mean_score',
    ];
}