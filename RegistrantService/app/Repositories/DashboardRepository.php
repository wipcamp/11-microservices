<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\DashboardRepositoryInterface;
use DB;
class DashboardRepository implements DashboardRepositoryInterface
{
    public function getStats()
    {
        $total_applicant = Profile::count();
        $total_success = Profile::where('confirm_register', 1)->count();
        $total_unsuccess = Profile::where('confirm_register', '!=', 1)->orWhereNull('confirm_register')->count();
        return response()->json(['total_applicant' => $total_applicant,
            'total_success' => $total_success,
            'total_unsuccess' => $total_unsuccess]);
    }
    public function getStatsByMedic()
    {
        $total_applicant = Profile::where('confirm_register', 1)->where('allergic_drug',"!=", "-")->orWhere('cangenital_disease',"!=", "-")->get();
        return response()->json(['total_applicant' => $total_applicant]);
    }
    public function getStatsByFood()
    {
        $total_applicant = Profile::where('confirm_register', 1)->where('allergic_food',"!=", "-")->get();
        return response()->json(['total_applicant' => $total_applicant]);
    }
    public function getStatsByDate($start_date, $end_date)
    {
        $date = Profile::selectRaw('DATE(created_at) as date')->
        whereBetween(DB::raw('DATE(created_at)'), array($start_date, $end_date))->groupBy(DB::raw('DATE(created_at)'))->get();

        $count = Profile::selectRaw('count(*) as count')->
        whereBetween(DB::raw('DATE(created_at)'), array($start_date, $end_date))->groupBy(DB::raw('DATE(created_at)'))->get();
        return response()->json(['dates' => $date, 'counts' => $count]);
    }
    public function getStatsByTime($date)
    {
        $time = Profile::selectRaw('Hour(created_at) as time_one_hours')->
        whereDate('created_at',$date)->groupBy(DB::raw('HOUR(created_at)'))->get();

        $count = Profile::selectRaw('count(*) as count_one_hours')->
        whereDate('created_at',$date)->groupBy(DB::raw('HOUR(created_at)'))->get();
        return response()->json(['times' => $time, 'counts' => $count]);
    }
}
