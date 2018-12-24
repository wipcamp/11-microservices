<?php

namespace App\Repositories;

use App\Models\School;
use App\Repositories\SchoolRepositoryInterface;

class SchoolRepository implements SchoolRepositoryInterface
{

    public function getSchool()
    {
        $school = School::all();
        return $school;
    }
    public function findSchoolByName($school_name)
    {
        $school = School::where('school_name', 'LIKE','%'. $school_name.'%')->get();
        return $school;
    }

}
