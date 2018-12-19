<?php
namespace App\Models;

// use Tymon\JWTAuth\Contracts\JWTSubject;

class Authentication
//  implements JWTSubject
{
  public function getJWTIdentifier()
  {
      return $this->getKey();
  }
  public function getJWTCustomClaims()
  {
      return [];
  }
}