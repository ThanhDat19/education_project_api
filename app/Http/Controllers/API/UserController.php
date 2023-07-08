<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\Courses;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $input = $request->all();
        Auth::attempt($input);

        $user = Auth::user();

        $token = $user->createToken('example')->accessToken;
        return response()->json([
            "token" => $token,
            "status" => 200
        ]);
    }

    public function getUserDetail()
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            return response()->json([
                "data" => $user,
                "status" => 200
            ]);
        }
        return response()->json([
            "data" => 'Unauthenticated',
            "status" => 401
        ]);
    }


    public function userLogout()
    {
        $accessToken = Auth::guard('api')->user()->token();
        \DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken)
            ->update(['revoked' => true]);
        $accessToken->revoke();

        return response()->json([
            "data" => 'Unauthenticated',
            "message" => 'User logout successfully',
            "status" => 200
        ]);
    }

    public function getListStudent(Request $request)
    {
        $perPage = 6; // Số học viên trên mỗi trang
        $page = $request->page; // Trang hiện tại

        $user = User::find($request->user_id);
        if ($user) {
            $roles = $user->roles;
            $teacherRole = $roles->firstWhere('name', 'teacher');
            $categories = CourseCategory::all();

            if ($teacherRole) {
                $courses = Courses::where('instructor', $user->id)->paginate($perPage, ['*'], 'page', $page);
                $totalPages = $courses->lastPage();

                $students = User::join('course_students', 'users.id', '=', 'course_students.user_id')
                    ->join('courses', 'course_students.course_id', '=', 'courses.id')
                    ->whereIn('course_students.course_id', $courses->pluck('id'))
                    ->paginate($perPage, ['*'], 'page', $page);

                // Lấy thông tin các khóa học thuộc course
                foreach ($students as $student) {
                    $course = $courses->firstWhere('id', $student->course_id);
                    $student->course = $course;
                    // $student->lessons = $course->lessons;
                    $student->lessons = Lesson::where('course_id', $course->id)->count();
                }

                return response()->json([
                    "total_pages" => $totalPages,
                    "courses" => $courses,
                    "students" => $students,
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

    public function updateInformation(Request $request, User $user)
    {


        try {
            // Lấy dữ liệu từ request
            $name = $request->input('name');
            $email = $request->input('email');

            $user->name = $name;
            $user->email = $email;

            $role = $user->roles()->pluck('name')->first();
            if ($request->hasFile('avarta')) {
                $name = $request->file('avarta')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y/m/d");
                $path = $request->file('avarta')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                $user->avarta = '/storage/' . $pathFull . '/' . $name;
            }

            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'Information updated successfully',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'roles' => $role,
                    'avarta' => $user->avarta
                ],
            ]);

        } catch (Exception $error) {
            return response()->json(['success' => false, 'message' => 'Có lỗi vui lòng thử lại']);
        }
    }
}
