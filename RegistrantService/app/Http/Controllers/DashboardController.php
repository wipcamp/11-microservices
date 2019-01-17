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
    public function getRegistrantStats(){
      return  response()->json([$this->dashboard->getStats()]);
    }
    public function getRegistrantStatsByDate (Request $req){
        $start_date = $req->query('startdate');
        $end_date = $req->query('enddate');
        return $this->dashboard->getStatsByDate($start_date,$end_date);
    }
}
