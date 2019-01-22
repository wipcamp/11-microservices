<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerEvaluation extends Model
{
    protected $table = 'answer_evaluations';
    protected $fillable = ['answer_id','checker_wip_id','question_id','score','score_category'];

    public $timestamps = false;
    public $timestamp = false;
}