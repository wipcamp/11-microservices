<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['question_id','wip_id','ans_content'];
    protected $hidden =['created_at','updated_at'];

    public function questions(){
        $this->belongsTo('App\Models\Question'.'question_id');
    }
    public function profiles(){
        $this->belongsTo('App\Models\Profile','wip_id');
    }
}
