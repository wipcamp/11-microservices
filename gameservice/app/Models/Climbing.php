<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Climbing extends Model
{
  protected $table = 'Climbing';
  protected $fillable = ['player_name','score'];
  protected $hidden =['created_at','updated_at'];
}
