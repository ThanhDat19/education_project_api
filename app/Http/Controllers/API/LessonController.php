<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\CourseStudent;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\User;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function getListLessonOfCourse($id)
    {
        $course = Courses::where('id', $id)->first();
        $lessons = Lesson::where('course_id', $course->id)
            ->with([
                'students' => function ($query) {
                    $query->select('users.*', 'lesson_students.watched_video');
                }
            ])
            ->get();

        return response()->json($lessons);
    }

    public function getLessonOfStudent(Request $request, User $user)
    {

        $lesson = Lesson::find($request->input('lesson_id'));
        $course = Lesson::find($request->input('course_id'));
        $lessonOfStudent = $user->lessons()
            ->where('lessons.id', $lesson->id)
            ->wherePivot('course_id', $course->id)
            ->exists();
        $message = "";
        if ($lessonOfStudent) {
            $message = 'rồi nha';
        } else {
            $message = 'chưa nha';
            $lessonOfStudent = $user->lessons()->attach($lesson->id, ['course_id' => $course->id, 'watched_video' => 0]);
        }
        return response()->json([
            'request' => $request->input(),
            'user' => $user,
            "message" => $message,
            "lesson_of_student" => $lessonOfStudent
        ]);

    }

    public function updateLessonOfStudent(Request $request, User $user)
    {
        $lesson = Lesson::find($request->input('lesson_id'));
        $course = Lesson::find($request->input('course_id'));
        $watched_time = $request->input('current_time');
        $lessonOfStudent = LessonStudent::where([
            'lesson_id' => $lesson->id,
            'course_id' => $course->id,
            'user_id' => $user->id
        ])->first();
        $courseStudent = CourseStudent::where([
            'user_id' => $user->id,
            'course_id' => $course->id
        ])->first();
        if ($lessonOfStudent) {

            if ($lessonOfStudent->watched_video < $watched_time)
                $lessonOfStudent->watched_video = $watched_time;

            $lessonCheck = ($lessonOfStudent->watched_video / $lesson->video_time) * 100;
            if ($lessonCheck >= 80) {
                $lessonOfStudent->lesson_status = 1;

                $courseStudent->status_course += 1;
            }
            $lessonOfStudent->save();
            $courseStudent->save();

            return response()->json([
                "message" => "success",
                "lesson_of_student" => $lessonOfStudent
            ], 200);
        } else {
            return response()->json([
                "message" => "Error",
            ], 401);
        }
    }
}
