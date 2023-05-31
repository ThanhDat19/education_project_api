<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function getListLessonOfCourse($id){
        $course = Courses::where('id', $id)->first();
        $lessons = Lesson::where('course_id', $course->id)->get();
        return response()->json($lessons);
    }
}
