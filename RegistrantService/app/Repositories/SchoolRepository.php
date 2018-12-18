<?php

namespace App\Repositories;
use App\Repositories\SchoolRepositoryInterface;
use App\Models\School;

class SchoolRepository implements SchoolRepositoryInterface{

    public function getSchool(){
        $school = School::all();
        return $school;
    }

}