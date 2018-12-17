<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $hidden = ['intelligent_weight','communication_weight','creative_weight'];
}
