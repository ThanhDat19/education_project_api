<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\Courses;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::all();
        $courses = Courses::paginate(10);
        return view('admin.course.list', [
            'title' => 'Danh Sách Khóa Học',
            'courses' => $courses,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $courseCategories = CourseCategory::all();
        return view('admin.course.add', [
            'title' => 'Thêm Khóa Học',
            'categories' => $courseCategories
        ]);
    }

    public function store(Request $request)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
            'numeric' => 'Trường :attribute phải là một số.',
            'date_format' => 'Trường :attribute phải có định dạng ngày-tháng-năm.',
        ];

        $validator = Validator::make($request->all(), [
            'course_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'start_date' => 'required|date_format:d-m-Y',
            'published' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $timestamp = Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->timestamp;
        $datetime = DateTime::createFromFormat('U', $timestamp);

        try {
            Courses::create([
                'instructor' => Auth::user()->id,
                'course_category_id' => $request->input('course_category_id'),
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title'), '-'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'course_image' => $request->input('image'),
                'start_date' => $datetime,
                'published' => $request->input('published'),
            ]);
            Session::flash('success', 'Thêm khóa học mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi, vui lòng thử lại');
        }

        return redirect()->back();

    }


    public function show(Courses $course)
    {
        $courseCategories = CourseCategory::all();
        return view('admin.course.edit', [
            'title' => 'Chỉnh Sửa Khóa Học ' . $course->title,
            'course' => $course,
            'categories' => $courseCategories
        ]);
    }

    public function update(Request $request, Courses $course)
    {

        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
            'numeric' => 'Trường :attribute phải là một số.',
            'date_format' => 'Trường :attribute phải có định dạng ngày-tháng-năm.',
        ];

        $validator = Validator::make($request->all(), [
            'course_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'start_date' => 'required|date_format:d-m-Y',
            'published' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $timestamp = Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->timestamp;
            $datetime = DateTime::createFromFormat('U', $timestamp);

            $course->fill([
                'instructor' => Auth::user()->id,
                'course_category_id' => $request->input('course_category_id'),
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title'), '-'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'course_image' => $request->input('image'),
                'start_date' => $datetime->format('Y-m-d H:i:s'),
                'published' => $request->input('published'),
            ]);
            $course->save();
            Session::flash('success', 'Cập nhật khóa học thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi, vui lòng thử lại');
        }

        return redirect()->back();
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $course = Courses::where('id', $request->input('id'))->first();

            if ($course) {
                $course->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa khóa học thành công'
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
