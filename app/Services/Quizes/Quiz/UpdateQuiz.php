<?php

namespace App\Services\Quizes\Quiz;

use App\Models\Quizes\Quiz;
use App\Services\Quizes\Question\CreateQuestion;
use Illuminate\Support\Facades\DB;

class UpdateQuiz {
    /**
     * Update a Quiz
     * 
     * @param array $data, int $id
     * @return Quiz
     */
    public function execute(array $data, $id) : Quiz {
        DB::beginTransaction();

        $quiz = Quiz::findOrFail($id);
        if(isset($data['questions']) && !empty($data['questions'])) {
            foreach($quiz->questions as $question) {
                foreach($question->answers as $answer) {
                    $answer->delete();
                }
                $question->delete();
            } 

            $this->questions($data['questions'], $quiz->id);
        }
        $quiz->update($data);

        DB::commit();
        return $quiz;
    }

    private function questions(array $data, $id) : void {
        foreach($data as $question) {
            $question['quizId'] = $id;
            app(CreateQuestion::class)->execute($question, $id);
        }
    }
}