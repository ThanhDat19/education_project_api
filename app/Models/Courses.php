<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'instructor',
        'course_category_id',
        'title',
        'slug',
        'price',
        'description',
        'course_image',
        'start_date',
        'published',
        'type'
    ];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
