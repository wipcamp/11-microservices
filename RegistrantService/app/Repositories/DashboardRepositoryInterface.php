<?php

namespace App\Repositories;

interface DashboardRepositoryInterface
{
    public function getStats();
    public function getStatsByMedic();
    public function getStatsByFood();
    public function getStatsByDate($start_date,$end_date);
    public function getStatsByTime($date);
}
