<?php

namespace App\Services\Quizes\Question;

use App\Models\Quizes\Question;
use Illuminate\Support\Facades\DB;

class DestroyQuestion {
    /**
     * Destroy a Question
     * 
     * @param int $id
     * @return void
     */
    public function execute($id) : void {
        DB::beginTransaction();

        $question = Question::findOrFail($id);
        foreach($question->answers as $answer) {
            $answer->delete();
        }

        $question->delete();

        DB::commit();
    }
}