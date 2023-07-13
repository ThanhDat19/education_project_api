<?php

namespace App\Http\Resources;

use App\Models\ClientReview;
use App\Models\CourseStudent;
use App\Models\Lesson;
use App\Models\QuestionType;
use App\Models\User;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            "title" => $this->title,
            "slug" => $this->slug,
            "price" => $this->price,
            "description" => $this->description,
            "course_image" => $this->course_image,
            "start_date" => $this->start_date,
            "published" => $this->published,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "instructor" => User::find($this->instructor),
            "category" => $this->category,
            "lessons" => $this->lessons,
            "type" => QuestionType::where('id', $this->type)->first(),
            "lessonCount" => Lesson::where('course_id', $this->id)->count(),
            "studentCount" => CourseStudent::where('course_id', $this->id)->count(),
            "lessonTimeCount" => Lesson::select('video_time')->where('course_id', $this->id)->sum('video_time'),
            "discount" => Discount::where('course_id', $this->id)
                ->orderBy('created_at', 'desc')
                ->first(),
            "averageRating" => CourseStudent::where('course_id', $this->id)->avg('rating'),
            "reviews" => ClientReview::join('users', 'client_reviews.user_id', '=', 'users.id')
                ->where(['client_reviews.courses_id' => $this->id, 'client_reviews.impolite' => 0])
                ->selectRaw('client_reviews.*, users.id AS user_id, users.name AS user_name')
                ->get(),
        ];
    }
}
