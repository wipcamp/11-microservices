<?php
namespace App\Repositories;
interface CampersRepositoryInterface {
    public function getCampers();
    public function getCamperByWipId($id);
}