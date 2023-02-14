<?php

namespace App\Services\Quizes\Quiz;

use App\Models\Quizes\Quiz;
use Illuminate\Support\Facades\DB;

class DestroyQuiz {
    /**
     * Destroy a Quiz
     * 
     * @param int $id
     * @return void
     */
    public function execute($id) : void {
        DB::beginTransaction();

        $quiz = Quiz::findOrFail($id);
        foreach($quiz->questions as $question) {
            foreach($question->answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        }
        $quiz->delete();

        DB::commit();
    }
}