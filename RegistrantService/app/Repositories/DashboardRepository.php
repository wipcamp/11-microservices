<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\DashboardRepositoryInterface;
use DB;
use Carbon\Carbon;
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
    public function getStatsByDate($start_date, $end_date)
    {
        $date = Profile::select(DB::raw('DATE(created_at) as date'))->
        whereBetween(DB::raw('DATE(created_at)'), array($start_date, $end_date))->groupBy('created_at')->get();

        $count = Profile::select(DB::raw('count(*) as count'))->
        whereBetween(DB::raw('DATE(created_at)'), array($start_date, $end_date))->groupBy('created_at')->get();
        return response()->json(['dates' => $date, 'counts' => $count]);
    }
}
