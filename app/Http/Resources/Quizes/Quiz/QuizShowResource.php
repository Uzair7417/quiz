<?php

namespace App\Http\Resources\Quizes\Quiz;

use App\Http\Resources\Quizes\Question\QuestionListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'isPublish' => $this->when($this->isPublish == 1, true) ? $this->when($this->isPublish == 1, true) : false,
            'questions' => QuestionListResource::collection($this->questions),
        ];
    }
}
