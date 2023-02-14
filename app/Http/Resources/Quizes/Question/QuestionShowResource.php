<?php

namespace App\Http\Resources\Quizes\Question;

use App\Http\Resources\Quizes\Answer\AnswerListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionShowResource extends JsonResource
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
            'question' => $this->question,
            'answers' => AnswerListResource::collection($this->answers),
        ];

        if($this->isMandatory == 1) {
            $data['isMandatory'] = true;
        } else {
            $data['isMandatory'] = false;
        }
        return $data;
    }
}
