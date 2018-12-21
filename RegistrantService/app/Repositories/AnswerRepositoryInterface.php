<?php

namespace App\Repositories;
use Illuminate\Http\Request;


interface AnswerRepositoryInterface{

    public function findAllAnswersById(int $id);
    public function createAnswer($answers);
    public function editAnswer(Request $request);
    }

