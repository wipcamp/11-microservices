<?php

namespace App\Repositories;

use App\Repositories\FlavorsRepositoryInterface;
use App\Models\Flavors;

class FlavorsRepository implements FlavorsRepositoryInterface
{
 public function getFlavors()
 {
   $flavors = Flavors::all();
   return $flavors;
 } 
}
