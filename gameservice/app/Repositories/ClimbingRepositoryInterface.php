<?php
namespace App\Repositories;

interface ClimbingRepositoryInterface
{
    public function getScore();
    public function setScore($user);
    public function getScores();
     
}