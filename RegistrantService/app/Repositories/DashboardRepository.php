<?php

namespace App\Repositories;

use App\Repositories\DashboardRepositoryInterface;
use App\Models\Registrant;
use App\Models\Profile;
class DashboardRepository implements DashboardRepositoryInterface{
    public function getStats(){
        $total_applicant = Profile::count();
        $total_success = Profile::where('confirm_register',1)->count();
        $total_unsuccess=Profile::where('confirm_register','!=',1)->orWhereNull('confirm_register')->count();
        return  response()->json(['total_applicant'=>$total_applicant,
                                  'total_success'=>$total_success,
                                  'total_unsuccess'=>$total_unsuccess]);
    }
}
