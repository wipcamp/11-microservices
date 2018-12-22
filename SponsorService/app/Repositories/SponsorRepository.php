<?php

namespace App\Repositories;

use App\Models\Sponsor;

class SponsorRepository implements SponsorRepositoryInterface
{
    public function getPosts(){
        return Sponsor::get();
    }

    public function getPost($sponsor_id){
        return Sponsor::Where('sponsor_id' , $sponsor_id)->get()->first();
    }

    public function create($spon){
        $newspon =new Sponsor();
        return $newspon::create($spon);
    }

    public function updatespon($id,$spon){
        return Sponsor::where('sponsor_id', $id)->update(['sponsor_name' => $spon['sponsor_name']]);
    }

    public function delete($sponsor_id){
        $spon = Sponsor::where('sponsor_id' , $sponsor_id);
        return $spon->delete();
    }
}
