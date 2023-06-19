<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $courseCategories = CourseCategory::paginate(10);
        return view('admin.course_categories.list', [
            'title' => 'Danh Sách Loại Khóa Học',
            'courseCategories' => $courseCategories
        ]);
    }

    public function create()
    {
        $courseCategories = CourseCategory::all();
        return view('admin.course_categories.add', [
            'title' => 'Thêm Loại Khóa Học',
            'categories' => $courseCategories
        ]);
    }

    public function store(Request $request)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'title' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            CourseCategory::create([
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('name'), '-'),
            ]);

            Session::flash('success', 'Thêm loại khóa học mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi, vui lòng thử lại');
        }

        return redirect()->back();
    }


    public function show(CourseCategory $category)
    {
        return view('admin.course_categories.edit', [
            'title' => 'Chỉnh Sửa Loại Khóa Học ' . $category->name,
            'category' => $category
        ]);
    }

    public function update(Request $request, CourseCategory $category)
    {

        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'title' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category->fill([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('name'), '-'),
        ]);
        $category->save();

        try {
            Session::flash('success', 'Cập nhật loại khóa học thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi, vui lòng thử lại');
        }

        return redirect()->back();
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $course = CourseCategory::where('id', $request->input('id'))->first();

            if ($course) {
                $course->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa loại khóa học thành công'
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
