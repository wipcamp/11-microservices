<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProviderUser extends Model
{
    protected $guarded = [
        'id', 'provider_id', 'provider_name'
    ];
}