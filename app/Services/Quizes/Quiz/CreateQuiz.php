<?php

namespace App\Services\Quizes\Quiz;

use App\Models\Quizes\Quiz;
use App\Services\Quizes\Question\CreateQuestion;
use Illuminate\Support\Facades\DB;

class CreateQuiz {
    /**
     * Create a Quiz
     * 
     * @param array $data
     * @return Quiz
     */
    public function execute(array $data) : Quiz {
        DB::beginTransaction();

        $quiz = Quiz::create($data);
        if(isset($data['questions']) && !empty($data['questions'])) {
            $this->questions($data['questions'], $quiz->id);
        }

        DB::commit();
        return $quiz;
    }

    private function questions(array $data, $id) {
        foreach($data as $question) {
            $question['quizId'] = $id;
            app(CreateQuestion::class)->execute($question);
        }
    }
}