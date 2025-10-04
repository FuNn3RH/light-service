<?php

namespace App\Http\Resources\Hoosh;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'main_question_id' => $this->main_question_id,
            "content" => $this->content,
            "image" => $this->image,
            "score" => $this->score,
            "type" => $this->type,
            "showType" => $this->showType,
            "options" => $this->options,
            "level" => $this->level,
            "category" => $this->category,
        ];
    }
}
