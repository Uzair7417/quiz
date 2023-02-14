<?php

namespace App\Services\Quizes\Question;

use App\Models\Quizes\Question;
use App\Services\Quizes\Answer\CreateAnswer;
use Illuminate\Support\Facades\DB;

class UpdateQuestion {
    /**
     * Update a Question
     * 
     * @param array $data, int $id
     * @return Question
     */
    public function execute(array $data, $id) : Question {
        DB::beginTransaction();

        $question = Question::findOrFail($id);
        if(isset($data['answers']) && !empty($data['answers'])) {
            foreach($question->answers as $answer) {
                $answer->delete();
            }

            $this->answers($data['answers'], $question->id);
        }
        $question->update($data);

        DB::commit();
        return $question;
    }

    private function answers(array $data, $id) {
        foreach ($data as $answer) {
            $answer['questionId'] = $id;
            app(CreateAnswer::class)->execute($answer);
        }
    }
}