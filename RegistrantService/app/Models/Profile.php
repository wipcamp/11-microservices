<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $guarded = [
      'wip_id', 'citizen_no',
    ];
    protected $primaryKey = 'wip_id';

    public $timestamps = false;

    public function answers(){
        return $this->hasMaNy('App\Models\Answer','wip_id');
    }
}

