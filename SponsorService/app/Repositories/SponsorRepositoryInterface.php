<?php 
namespace App\Repositories;

interface SponsorRepositoryInterface {
  public function getSponsors();
  public function getSponsor($sponsor_id); 
  public function create($spon); 
  public function updatesponname($id,$spon);
  public function delete($id);
}



