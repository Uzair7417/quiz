<?php

namespace App\Services\Quizes\Question;

use App\Models\Quizes\Question;
use App\Services\Quizes\Answer\CreateAnswer;
use Illuminate\Support\Facades\DB;

class CreateQuestion {
    /**
     * Create a Question
     * 
     * @param array $data
     * @return Question
     */
    public function execute(array $data) : Question {
        DB::beginTransaction();

        $question = Question::create($data);
        if(isset($data['answers']) && !empty($data['answers'])) {
            $this->answers($data['answers'], $question->id);
        }

        DB::commit();
        return $question;
    }

    private function answers(array $data, $id) : void {
        foreach ($data as $answer) {
            $answer['questionId'] = $id;
            app(CreateAnswer::class)->execute($answer);
        }
    }
}