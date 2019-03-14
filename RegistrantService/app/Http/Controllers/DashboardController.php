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
    public function getRegistrantStatsMedic(){
        return  response()->json([$this->dashboard->getStatsByMedic()]);
      }
    public function getRegistrantStatsFood(){
        return  response()->json([$this->dashboard->getStatsByFood()]);
      }
    public function getRegistrantStatsByDate (Request $req){
        $start_date = $req->query('startdate');
        $end_date = $req->query('enddate');
        return $this->dashboard->getStatsByDate($start_date,$end_date);
    }
    public function getRegistrantStatsByTime(Request $req){
        $date = $req->query('date');
        return $this->dashboard->getStatsByTime($date);
    }
}
