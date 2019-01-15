<?php

namespace App\Repositories;

interface DashboardRepositoryInterface {
   public function getRegistrantStats();
   public function getRegistrantStatsByDate();
   public function getRegistrantStatsByTime();

}
