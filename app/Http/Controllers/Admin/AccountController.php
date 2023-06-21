<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

    }
    public function teacherStore()
    {

    }

    public function teacherShow()
    {

    }
    public function studentList()
    {

    }

    public function studentShow()
    {

    }

    public function studentPut()
    {

    }
}
