<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'teacher_id',

    ];
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
}
