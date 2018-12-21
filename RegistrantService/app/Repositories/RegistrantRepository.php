<?php
namespace App\Repositories;

use App\Models\Registrant;
use App\Repositories\RegistrantRepositoryInterface;

class RegistrantRepository implements RegistrantRepositoryInterface
{
  public function getRegistrant()
  {
    $registrants = Registrant::all();
    return $registrants;
  }
}