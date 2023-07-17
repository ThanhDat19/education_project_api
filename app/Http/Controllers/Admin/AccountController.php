<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Role;
use App\Models\User;
use App\Models\Courses;
use App\Models\CourseStudent;
use App\Models\CourseTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function teacherList()
    {
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->paginate(10);
        return view('admin.accounts.admins.list', [
            'title' => 'Danh Sách Giảng Viên',
            'teachers' => $teachers
        ]);
    }
    public function teacherAdd()
    {
        return view('admin.accounts.admins.add', [
            'title' => 'Thêm giảng viên ',
        ]);
    }
    public function teacherStore(Request $request)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ], $customMessages);

        if ($validator->fails()) {
            $studentRole = Role::firstOrCreate(['name' => 'teacher']);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            $user->roles()->attach($studentRole);
            Session::flash('success', 'Tạo giảng viên thành công');
        } else {
            Session::flash('error', 'Thất bại vui lòng kiểm tra');
        }
        return redirect()->back();
    }

    public function teacherShow(User $user)
    {
        $course_id = CourseTeacher::where('teacher_id', $user->id)->value('course_id');
        $courses = Courses::where('instructor', $user->id)->paginate(10);

        return view('admin.accounts.admins.show', [
            'title' => 'Thông tin chi tiết',
            'user' => $user,
            'courses' => $courses
        ]);
    }
    public function studentList()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->paginate(10);
        return view('admin.accounts.users.list', [
            'title' => 'Danh Sách Sinh Viên',
            'students' => $students
        ]);
    }

    public function studentShow(User $user)
    {
        if ($user) {
            $roles = $user->roles;
            $studentRole = $roles->firstWhere('name', 'student');

            if ($studentRole) {
                $courses = Courses::join('course_students', 'courses.id', '=', 'course_students.course_id')
                    ->where('course_students.user_id', $user->id)
                    ->paginate(10);

                foreach ($courses as $course) {
                    $course->lessons = Lesson::where('course_id', $course->course_id)->count();
                }
                return view('admin.accounts.users.show', [
                    'title' => 'Thông tin chi tiết',
                    'user' => $user,
                    'courses' => $courses

                ]);
            }
        }
    }

    public function userShow(User $user)
    {

        $user = Courses::where('id', 1)->get();


        return view('admin.profile.edit', [
            'title' => 'Thông tin chi tiết',
            'user' => $user,


        ]);

    }

    public function userUpdate(User $user, Request $request)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user->fill([
                'name' => $request->input('name'),
                'email' => $request->input('email'),

            ]);
            if ($request->input('image')) {
                $user->avarta = $request->input('image');
            }
            $user->save();
            Session::flash('success', 'Cập nhật thông tin thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi, vui lòng thử lại');
        }


        return redirect()->back();
    }

    public function studentDelete(Request $request)
    {
        try {
            $result = false;
            $user = User::where('id', $request->input('id'))->first();

            if ($user) {
                $user->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa user thành công'
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
