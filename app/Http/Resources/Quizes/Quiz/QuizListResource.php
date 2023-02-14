<?php

namespace App\Http\Resources\Quizes\Quiz;

use App\Http\Resources\Quizes\Question\QuestionListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'questions' => QuestionListResource::collection($this->questions),
        ];

        if($this->isPublish == 1) {
            $data['isPublish'] = true;
        } else {
            $data['isPublish'] = false;
        }
        return $data;
    }
}
