<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
                "test_id"=> $this->test_id,
                "question"=> $this->question,
                "question_image"=>$this->question_image,
                "score"=>$this->score,
                "created_at"=> $this->created_at,
                "updated_at"=> $this->updated_at,
                "deleted_at"=>null,
                "options" => $this->options
        ];
    }
}
