<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Lesson;
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
        return view('admin.tests.add', [
            'title' => 'Thêm Bài Kiểm Tra',
            'courses' => $course
        ]);
    }

    public function store(Request $request)
    {
        Test::create([
            'title' => $request->input('title'),
            'course_id' => $request->input('course_id'),
            'lesson_id' => $request->input('lesson_id'),
            'description' => $request->input('description'),
            'published' => $request->input('published')
        ]);

        try {

            Session::flash('success', 'Thêm bài kiểm tra mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->back();
    }


    public function show(Test $test)
    {
        $course = Courses::all();
        return view('admin.tests.edit', [
            'title' => 'Chỉnh Sửa Bài Kiểm Tra ' . $test->title,
            'courses' => $course,
            'test' => $test
        ]);
    }

    public function update(Request $request, Test $test)
    {
        $test->fill([
            'title' => $request->input('title'),
            'course_id' => $request->input('course_id'),
            'lesson_id' => $request->input('lesson_id'),
            'description' => $request->input('description'),
            'published' => $request->input('published')
        ]);
        $test->save();
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
