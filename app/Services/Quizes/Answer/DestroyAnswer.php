<?php

namespace App\Services\Quizes\Answer;

use App\Models\Quizes\Answer;
use Illuminate\Support\Facades\DB;

class DestroyAnswer {
    /**
     * Destroy a Answer
     * 
     * @param int $id
     * @return void
     */
    public function execute($id) : void {
        DB::beginTransaction();

        $answer = Answer::findOrFail($id);
        $answer->delete();

        DB::commit();
    }
}