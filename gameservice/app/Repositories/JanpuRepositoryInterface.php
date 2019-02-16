<?php
namespace App\Repositories;

interface JanpuRepositoryInterface
{
    public function getScore();
    public function setScore($user);
    public function getScores();
     
}