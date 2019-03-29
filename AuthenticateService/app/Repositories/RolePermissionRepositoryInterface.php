<?php
namespace App\Repositories;

interface RolePermissionRepositoryInterface{
  public function getPermissionByRole($role_id);
  public function getPermissionByWipId($role_id); 
  public function getRoleForRegistrants($role_id);
  public function getRoleOnlyByWipId($wip_id);
  public function getforPermissionAll();
  public function getallRoles();
  public function updateRoleWip($data);
  public function changeRoleByWipId($wipId,$role);
}