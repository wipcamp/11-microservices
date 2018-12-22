<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Authentication extends Authenticatable implements JWTSubject
{

    protected $fillable = [
        'provider_id', 'provider_name', 'accessToken'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

  protected $table = 'credential';
  public $timestamps = false;

  public function getJWTIdentifier()
  {
      return $this->getKey();
  }
  public function getJWTCustomClaims()
  {
      return [];
  }
}