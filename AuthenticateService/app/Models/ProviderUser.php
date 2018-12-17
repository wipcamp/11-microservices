<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProviderUser extends Model
{
    protected $guarded = [
        'id', 'provider_id', 'provider_name'
    ];
    // public function user()
    // {
    //     return $this->belongsTo('App\User', 'id', 'user_id');
    // }
    // public function provider()
    // {
    //     return $this->belongsTo('App\Models\Provider', 'id', 'provider_id');
    // }
}