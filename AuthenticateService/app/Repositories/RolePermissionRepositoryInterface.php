<?php
namespace App\Repositories;

interface RolePermissionRepositoryInterface{
  public function getPermissionByRole($role_id);
  public function getPermissionByWipId($role_id); 
}