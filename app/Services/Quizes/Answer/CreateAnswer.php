<?php

namespace App\Services\Quizes\Answer;

use App\Models\Quizes\Answer;
use Illuminate\Support\Facades\DB;

class CreateAnswer {
    /**
     * Create a Answer
     * 
     * @param array $data
     * @return Answer
     */
    public function execute(array $data) : Answer {
        DB::beginTransaction();

        $answer = Answer::create($data);

        DB::commit();
        return $answer;
    }
}