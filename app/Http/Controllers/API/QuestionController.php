<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\QuestionType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function getQuestions(Request $request, User $user)
    {
        $perPage = 6; // Number of courses per page
        $page = $request->page; // Current page

        $roles = $user->roles;
        $teacherRole = $roles->firstWhere('name', 'teacher');
        $questionTypes = QuestionType::all();

        if ($teacherRole) {
            $questions = Question::paginate($perPage, ['*'], 'page', $page);
            $totalPages = $questions->lastPage();

            return response()->json([
                "total_pages" => $totalPages,
                "questions" => $questions,
                "questionTypes" => $questionTypes,
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
    }
}
