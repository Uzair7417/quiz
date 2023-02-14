<?php

namespace App\Services\Quizes\Answer;

use App\Models\Quizes\Answer;
use Illuminate\Support\Facades\DB;

class UpdateAnswer {
    /**
     * Update a Answer
     * 
     * @param array $data, int $id
     * @return Answer
     */
    public function execute(array $data, $id) : Answer {
        DB::beginTransaction();

        $answer = Answer::findOrFail($id);
        $answer->update($data);

        DB::commit();
        return $answer;
    }
}