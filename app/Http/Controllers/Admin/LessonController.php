<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Lesson;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    private $youTubeController;
    function __construct(YouTubeController $youTubeController)
    {
        $this->youTubeController = $youTubeController;
    }

    public function index(Courses $course)
    {
        $lessons = Lesson::where('course_id', $course->id)->paginate(10);
        return view('admin.lessons.list', [
            'title' => 'Danh Sách Bài Học',
            'lessons' => $lessons,
            'course' => $course
        ]);
    }

    public function create(Courses $course)
    {
        return view('admin.lessons.add', [
            'title' => 'Thêm Bài Học Vào Khóa Học ' . $course->title,
            'course' => $course
        ]);
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

    public function store(Request $request, Courses $course)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'video_url' => 'required',
            'short_text' => 'required',
            'full_text' => 'required',
            'position' => 'required',
            'free_lesson' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $timeCode = $this->youTubeController->getVideoDuration($request->input('video_url'))->duration;
        // dd($this->getTime($timeCode));
        Lesson::create([
            'course_id' => $course->id,
            'title' => $request->input('title'),
            'video_url' => $request->input('video_url'),
            'short_text' => $request->input('short_text'),
            'video_time' => $this->getTime($timeCode),
            'full_text' => $request->input('full_text'),
            'position' => $request->input('position'),
            'free_lesson' => $request->input('free_lesson'),
        ]);

        try {
            Session::flash('success', 'Thêm Bài học mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi, vui lòng thử lại');
        }
        return redirect()->route('course.lesson', ['course' => $course->id]);
    }


    public function show(Lesson $lesson)
    {
        return view('admin.lessons.edit', [
            'title' => 'Chỉnh Sửa Bài Học ' . $lesson->title,
            'lesson' => $lesson
        ]);
    }

    public function update(Request $request, Lesson $lesson, Courses $course)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'video_url' => 'required',
            'short_text' => 'required',
            'full_text' => 'required',
            'position' => 'required',
            'free_lesson' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $lesson->fill([
                "course_id" => $course->id,
                "title" => $request->input('title'),
                "video_url" => $request->input('video_url'),
                "short_text" => $request->input('short_text'),
                "full_text" => $request->input('full_text'),
                "position" => $request->input('position'),
                "free_lesson" => $request->input('free_lesson')
            ]);
            $lesson->save();
            Session::flash('success', 'Cập nhật bài học thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->route('course.lesson', ['course' => $course->id]);
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $course = Lesson::where('id', $request->input('id'))->first();

            if ($course) {
                $course->delete();
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
