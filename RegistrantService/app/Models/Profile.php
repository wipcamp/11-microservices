<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $guarded = [
      'wip_id',
    ];
    protected $primaryKey = 'wip_id';
    public $timestamps = false;
    public $timestamp = false;

    public function answers(){
        return $this->hasMaNy('App\Models\Answer','wip_id','wip_id');
    }
}

