<?php

namespace App\Repositories;

use App\Models\Sponsor;

class SponsorRepository implements SponsorRepositoryInterface
{
    public function getSponsors(){
        return Sponsor::select('sponsor_path','sponsor_id')->orderBy('sponsor_order', 'asc')->get();
;
    }

    public function getSponsor($sponsor_id){
        return Sponsor::Where('sponsor_id' , $sponsor_id)->get()->first();
    }

    public function create($spon){
        $newspon =new Sponsor();
        return $newspon::create($spon);
    }

    public function updatesponname($id,$sponsor){
        $sponsors = Sponsor::where('sponsor_id',$id)->get()->first();
        $updatesponsor = $sponsors->update($sponsor);
        return response()->json($updatesponsor);
    }

    public function delete($sponsor_id){
        $spon = Sponsor::where('sponsor_id' , $sponsor_id);
        return $spon->delete();
    }
}
