<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Lesson;
use App\Models\QuestionType;
use App\Models\Question;
use App\Models\Test;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::paginate(10);
        return view('admin.tests.list', [
            'title' => 'Danh Sách Bài Kiểm Tra',
            'tests' => $tests
        ]);
    }

    public function create()
    {
        $course = Courses::all();
        $questionTypes = QuestionType::all();
        $questions = Question::all();
        return view('admin.tests.add', [
            'title' => 'Thêm Bài Kiểm Tra',
            'courses' => $course,
            'questionTypes' => $questionTypes,
            'questions' => $questions
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Lấy dữ liệu từ request
            $data = $request->validate([
                'title' => 'required|string',
                'course_id' => 'required|integer',
                'lesson_id' => 'required|integer',
                'description' => 'required|string',
                'questions' => 'required|array',
                'published' => 'required|integer',
            ]);

            // Tạo bài kiểm tra mới
            $test = Test::create([
                'title' => $data['title'],
                'course_id' => $data['course_id'],
                'lesson_id' => $data['lesson_id'],
                'description' => $data['description'],
                'published' => $data['published'],
            ]);

            // Liên kết các câu hỏi đã chọn với bài kiểm tra
            $questions = Question::whereIn('id', $data['questions'])->get();
            $test->questions()->attach($questions);
            Session::flash('success', 'Thêm bài kiểm tra mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->back();
    }


    public function show(Test $test)
    {
        $course = Courses::all();
        $questionTypes = QuestionType::all();
        $questions = Question::all();
        return view('admin.tests.edit', [
            'title' => 'Chỉnh Sửa Bài Kiểm Tra ' . $test->title,
            'courses' => $course,
            'test' => $test,
            'questionTypes' => $questionTypes,
            'questions' => $questions
        ]);
    }

    public function update(Request $request, Test $test)
    {
        // Lấy dữ liệu từ request
        $data = $request->validate([
            'title' => 'required|string',
            'course_id' => 'required|integer',
            'lesson_id' => 'required|integer',
            'description' => 'required|string',
            'questions' => 'required|array',
            'published' => 'required|integer',
        ]);

        $test->fill([
            'title' => $data['title'],
            'course_id' => $data['course_id'],
            'lesson_id' => $data['lesson_id'],
            'description' => $data['description'],
            'published' => $data['published'],
        ]);
        $test->save();

        // Cập nhật danh sách câu hỏi
        $questions = $request->input('questions', []);
        $test->questions()->sync($questions);
        try {
            Session::flash('success', 'Cập nhật bài kiểm tra thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $test = Test::where('id', $request->input('id'))->first();

            if ($test) {
                $test->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa bài kiểm tra thành công'
                ]);
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => true,
                'message' => 'Đã có lỗi xảy ra'
            ]);
        }
    }

    public function getLessonOfCourse(Request $request)
    {
        $courseId = $request->input('course_id');

        $lessons = Lesson::where('course_id', $courseId)->get();

        return view('admin.tests.lesson-of-course', [
            'lessons' => $lessons
        ]);
    }
}
