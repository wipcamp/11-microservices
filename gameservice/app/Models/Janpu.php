<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Janpu extends Model
{
  protected $table = 'janpu';
  protected $fillable = ['player_name','score'];
  protected $hidden =['created_at','updated_at'];


}
