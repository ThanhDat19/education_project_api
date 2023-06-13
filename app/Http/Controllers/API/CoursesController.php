<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\CourseStudent;
use App\Models\User;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    public function onSelectFour()
    {
        $result = Courses::limit(4)->get();
        return response()->json($result);
    }
    public function onSelectAll(Request $request)
    {
        $perPage = 6; // Number of courses per page
        $page = $request->page; // Current page
        $courses = Courses::paginate($perPage, ['*'], 'page', $page);
        $totalPages = $courses->lastPage(); // Use lastPage() method instead of accessing the protected property
        $categories = CourseCategory::all();
        return response()->json([
            "total_pages" => $totalPages,
            "courses" => $courses,
            "request" => $request->input(),
            "categories" => $categories,
        ]);
    }
    public function onSelectDetails(Request $request, $id)
    {
        $user = User::find($request->input('user_id'));
        $categories = CourseCategory::all();
        if ($user) {
            $course = Courses::where([
                'id' => $id
            ])->first();

            $courseStudent = CourseStudent::where([
                'user_id' => $user->id,
                'course_id' => $course->id
            ])->first();

            if ($courseStudent) {
                return response()->json([
                    "data" => $course,
                    "status" => $courseStudent->payment_status,
                    "categories" => $categories
                ], 200);
            }
            return response()->json([
                "data" => $course,
                "status" => null,
                "categories" => $categories
            ], 200);

        } else {
            $course = Courses::where([
                'id' => $id
            ])->first();

            return response()->json([
                "data" => $course,
                "status" => null,
                "categories" => $categories
            ], 200);
        }
    }

    public function teacherGetCourse(Request $request)
    {
        $perPage = 6; // Number of courses per page
        $page = $request->page; // Current page

        $user = User::find($request->user_id);
        if ($user) {
            $roles = $user->roles;
            $teacherRole = $roles->firstWhere('name', 'teacher');
            $categories = CourseCategory::all();

            if ($teacherRole) {
                $courses = Courses::where('instructor', $user->id)->paginate($perPage, ['*'], 'page', $page);
                $totalPages = $courses->lastPage(); // Use lastPage() method instead of accessing the protected property

                return response()->json([
                    "total_pages" => $totalPages,
                    "courses" => $courses,
                    "request" => $request->input(),
                    "categories" => $categories,
                ]);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
    }

    public function teacherPostCourse(Request $request)
    {

        // Lấy dữ liệu
        $newCourseTitle = $request->input('newCourseTitle');
        $courseCategoryId = $request->input('courseCategoryId');
        $description = $request->input('description');
        $price = $request->input('price');
        $user_id = $request->input('user_id');
        $dateString = $request->input('start_date');

        $timestamp = strtotime($dateString);
        $dateTime = date('Y-m-d H:i:s', $timestamp);
        // $datetime = DateTime::createFromFormat('U', $timestamp);
        // Lưu dữ liệu vào CSDL
        $course = new Courses();
        $course->instructor = $user_id;
        $course->course_category_id = $courseCategoryId;
        $course->title = $newCourseTitle;
        $course->slug = Str::slug($request->input('newCourseTitle'), '-');
        $course->description = $description;
        $course->price = $price;
        $course->published = false;
        $course->start_date = $dateTime;
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();

            $pathFull = 'uploads/' . date("Y/m/d");
            $path = $request->file('image')->storeAs(
                'public/' . $pathFull,
                $name
            );
            $course->course_image = '/storage/' . $pathFull . '/' . $name;
        }
        $course->save();

        // Phản hồi cho React rằng dữ liệu đã được lưu thành công
        return response()->json(['success' => true, 'message' => 'Course created successfully', 'course' => $course]);
    }

    public function teacherDeleteCourse(Courses $course)
    {
        try {
            $result = false;
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

    public function teacherUpdateCourse(Request $request, Courses $course)
    {
        // Lấy dữ liệu
        $newCourseTitle = $request->input('title');
        $courseCategoryId = $request->input('course_category_id');
        $description = $request->input('description');
        $price = $request->input('price');
        $user_id = $request->input('user_id');
        $dateString = $request->input('start_date');

        $timestamp = strtotime($dateString);
        $dateTime = date('Y-m-d H:i:s', $timestamp);
        $course->instructor = $user_id;
        $course->course_category_id = $courseCategoryId;
        $course->title = $newCourseTitle;
        $course->slug = Str::slug($request->input('title'), '-');
        $course->description = $description;
        $course->price = $price;
        $course->start_date = $dateTime;

        if ($course->course_image != $request->input('image')) {
            if ($request->hasFile('image')) {
                $name = $request->file('image')->getClientOriginalName();

                $pathFull = 'uploads/' . date("Y/m/d");
                $path = $request->file('image')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                $course->course_image = '/storage/' . $pathFull . '/' . $name;
            }
        }

        $course->save();

        return response()->json(['success' => true, 'message' => 'Course update successfully', 'course' => $course]);
    }
}
