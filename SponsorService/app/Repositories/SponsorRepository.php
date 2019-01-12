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

    public function updatesponname($spon,$id){
        return Sponsor::where('sponsor_id', $id)->update(['sponsor_name' => $spon]);
    }

    public function updatesponorder($spon,$id){
        return Sponsor::where('sponsor_id', $id)->update(['sponsor_order' => $spon]);
    }

    public function delete($sponsor_id){
        $spon = Sponsor::where('sponsor_id' , $sponsor_id);
        return $spon->delete();
    }
}
