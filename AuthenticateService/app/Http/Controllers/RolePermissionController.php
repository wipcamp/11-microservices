<?php

namespace App\Http\Controllers;

use App\Repositories\RolePermissionRepositoryInterface;

class RolePermissionController extends Controllers
{
  protected $rolepermission;

  public function __construct(RolePermissionRepositoryInterface $rolepermission)
  {
    $this->rolepermission = $rolepermission;
  }

  
}
