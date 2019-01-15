<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DashboardRepositoryInterface;

class DashboardController extends Controller
{
    protected $dashboard;
    public function __construct(DashboardRepositoryInterface $dashboardRepoInterface){
        $this->dashboard = $dashboardRepoInterface;
    }

}
