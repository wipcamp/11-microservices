<?php
namespace App\Repositories;

interface AuthenticationRepositoryInterface{
  public function getByProviderId($provider_id);
  public function createUser($data);
  public function updateByProviderId($provider_id, $wip_id);
  public function getRoleByWipId($wip_id);
  public function getPermissionByWipId($wip_id);
}
