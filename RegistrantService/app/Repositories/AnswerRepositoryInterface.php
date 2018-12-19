<?php

namespace App\Repositories;

interface AnswerRepositoryInterface{

    public function findAllAnswersById(int $id);
    public function createAnswer(Request $request);
    public function editAnswer(Request $request);
    }

