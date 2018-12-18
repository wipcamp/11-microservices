<?php

namespace App\Repositories;

interface ProfileRepositoryInterface {
    public function getProfile();  
    public function createProfile($profile);  
    public function getByWipId($wipId);
    public function updateProfile($wipId,$profile);
}