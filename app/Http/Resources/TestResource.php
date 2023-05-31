<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "course_id" => $this->course_id,
            "lesson_id" => $this->lesson_id,
            "title" => $this->title,
            "description" => $this->description,
            "published" => $this->published,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "questions" => QuestionResource::collection($this->questions)
        ];
    }
}
