<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function answers(){
        return $this->hasMaNy('App\Models\Answer','question_id');
    }
}
