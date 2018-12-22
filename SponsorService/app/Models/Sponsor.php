<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public $table = "sponsor";
    protected $fillable = ['sponsor_name','sponspr_id','sponsor_order','sponsor_path'];
}
