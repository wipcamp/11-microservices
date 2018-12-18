<?php
namespace App\Repositories;

interface AuthenticationRepositoryInterface{
  public function getByProviderId($provider_id);
  public function getByUserName($provider_name);
  public function createUser($data);
  public function updateByProviderId($provider_id, $wip_id);
}
