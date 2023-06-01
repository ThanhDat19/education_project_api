<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\CourseStudent;
use App\Models\User;
use Illuminate\Http\Request;

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

        return response()->json([
            "total_pages" => $totalPages,
            "courses" => $courses,
            "request" => $request->input(),
        ]);

    }
    public function onSelectDetails(Request $request, $id)
    {
        $user = User::find($request->input('user_id'));

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
                    "status" => $courseStudent->payment_status
                ], 200);
            }
            return response()->json([
                "data" => $course,
                "status" => null
            ], 200);

        } else {
            $course = Courses::where([
                'id' => $id
            ])->first();

            return response()->json([
                "data" => $course,
                "status" => null
            ], 200);
        }
    }
}
