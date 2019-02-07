<?php

namespace App\Repositories;

interface ChangeStatusRepositoryInterface
{
  public function changeStatusByWipId($wip_id,$status);
}