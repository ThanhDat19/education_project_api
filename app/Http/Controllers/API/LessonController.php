<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Admin\YouTubeController;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\CourseStudent;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class LessonController extends Controller
{
    private $youTubeController;
    function __construct(YouTubeController $youTubeController)
    {
        $this->youTubeController = $youTubeController;
    }
    public function getListLessonOfCourse($id)
    {
        $course = Courses::where('id', $id)->first();
        $lessons = Lesson::where('course_id', $course->id)
            ->with([
                'students' => function ($query) {
                    $query->select('users.*', 'lesson_students.watched_video', 'lesson_students.lesson_status');
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
            if ($lessonCheck >= 80 && $lessonOfStudent->lesson_status != 1) {
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

    public function getTime($timeCode)
    {
        $input = $timeCode;
        $reptms = '/^PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?$/';
        $hours = 0;
        $minutes = 0;
        $seconds = 0;
        $totalseconds = 0;

        if (preg_match($reptms, $input, $matches)) {
            if (isset($matches[1])) {
                $hours = (int) $matches[1];
            }
            if (isset($matches[2])) {
                $minutes = (int) $matches[2];
            }
            if (isset($matches[3])) {
                $seconds = (int) $matches[3];
            }
            $totalseconds = $hours * 3600 + $minutes * 60 + $seconds;
        }

        // $time = Carbon::createFromTimestamp($totalseconds)->format('H:i:s');
        return $totalseconds;
    }

    public function teacherPostLesson(Request $request, Courses $course): JsonResponse
    {
        $timeCode = $this->youTubeController->getVideoDuration($request->input('video_url'))->duration;
        // dd($this->getTime($timeCode));
        $lesson = Lesson::create([
            'course_id' => $course->id,
            'title' => $request->input('title'),
            'video_url' => $request->input('video_url'),
            'short_text' => $request->input('description'),
            'video_time' => $this->getTime($timeCode),
            'full_text' => $request->input('content'),
            'position' => $request->input('position'),
        ]);

        return response()->json($lesson, 201);
    }


    public function teacherUpdateLesson(Request $request, Lesson $lesson): JsonResponse
    {
        $timeCode = $this->youTubeController->getVideoDuration($request->input('video_url'))->duration;
        try {
            $lesson->update([
                "title" => $request->input('title'),
                "video_url" => $request->input('video_url'),
                'video_time' => $this->getTime($timeCode),
                "short_text" => $request->input('description'),
                "full_text" => $request->input('content'),
                "position" => $request->input('position'),
            ]);

            return response()->json($lesson, 200);
        } catch (\Exception $err) {

            return response()->json(['error' => 'Có lỗi, vui lòng thử lại'], 500);
        }
    }

    public function teacherDeleteLesson(Lesson $lesson)
    {
        try {
            $result = false;
            if ($lesson) {
                $lesson->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa Bài học thành công'
                ]);
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => true,
                'message' => 'Đã có lỗi xảy ra'
            ]);
        }
    }
}
