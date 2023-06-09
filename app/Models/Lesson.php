<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'course_id',
        'title',
        'video_time',
        'video_url',
        'short_text',
        'full_text',
        'position',
        'free_lesson',
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'id', 'course_id');
    }

    public function tests()
    {
        return $this->hasMany(Test::class, 'lesson_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'lesson_students')
            ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'lesson_id', 'id');
    }
}
