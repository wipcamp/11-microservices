<?php

namespace App\Repositories;

interface QuestionRepositoryInterface {

    public function findAllQuesions();
    public function findQuestionById($question_id);
}
