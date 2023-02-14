<?php

namespace App\Http\Resources\Quizes\Answer;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerShowResource extends JsonResource
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
            'answer' => $this->answer,
        ];
        
        if($this->isRight == 1) {
            $data['isRight'] = true;
        } else {
            $data['isRight'] = false;
        }
        return $data;

    }
}
