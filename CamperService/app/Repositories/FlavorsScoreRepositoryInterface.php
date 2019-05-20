<?php
namespace App\Repositories;
interface FlavorsScoreRepositoryInterface {
  public function insertScore($data);
  public function viewScores();
}