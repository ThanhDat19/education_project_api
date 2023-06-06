<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'course_id',
        'lesson_id',
        'description',
        'published'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'test_questions');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
}
