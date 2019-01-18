<?php

namespace App\Repositories;

interface DashboardRepositoryInterface
{
    public function getStats();
    public function getStatsByDate($start_date,$end_date);
    public function getStatsByTime($date);
}
