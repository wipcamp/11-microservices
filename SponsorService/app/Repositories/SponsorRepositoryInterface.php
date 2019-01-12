<?php 
namespace App\Repositories;

interface SponsorRepositoryInterface {
  public function getPosts();
  public function getPost($sponsor_id); 
  public function create($spon); 
  public function updatesponname($id, $spon);
  public function updatesponorder($id,$spon);
  public function delete($id);
}



