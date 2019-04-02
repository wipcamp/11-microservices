<?php

namespace App\Repositories;

interface ProfileRepositoryInterface {
    public function getProfile($wipId);  
    public function getProfiles($data);  
    public function createProfile($profile);  
    public function getByWipId($wipId);
    public function updateProfile($wipId,$profile);
}