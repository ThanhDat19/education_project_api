<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'user_id',
        'payment_id',
        'payment_status',
        'rating',
        'status_course'
    ];
}
