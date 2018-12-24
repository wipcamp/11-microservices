<?php

namespace App\Repositories;

interface SchoolRepositoryInterface {
    public function getSchool();
    public function findSchoolByName($school_name);
}
