<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [
      'wip_id', 'citizen_no', 
    ];

    public $timestamps = false;
}

