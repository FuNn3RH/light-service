<?php

namespace App\Http\Resources\Hoosh;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'answer_id' => $this->id,
            "main_id" => $this->mainQuestion->id,
            "main_title" => $this->mainQuestion->title,
            "question_id" => $this->question->id,
            "question_score" => $this->question->score,
            "question_text" => $this->question->content,
            "answer_text" => $this->answer_text,
        ];
    }
}
