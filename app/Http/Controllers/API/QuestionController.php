<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\QuestionOption;
use App\Models\QuestionType;
use App\Models\User;
use Exception;
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

    public function postQuestions(Request $request)
    {

        try {
            $question = new Question();

            $question->question_type_id = $request->input('question_type_id');
            $question->question = $request->input('question');
            $question->score = $request->input('score');
            $question->multi_answer = $request->input('multi_answer') ? 1 : 0;

            if ($request->hasFile('image')) {
                $name = $request->file('image')->getClientOriginalName();

                $pathFull = 'uploads/' . date("Y/m/d");
                $path = $request->file('image')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                $question->question_image = '/storage/' . $pathFull . '/' . $name;
            }

            $question->save();

            // Create question options
            $options = json_decode($request->input('options'), true);

            foreach ($options as $option) {
                $questionOption = new QuestionOption();
                $questionOption->question_id = $question->id;
                $questionOption->option_text = $option['content'];
                $questionOption->correct = $option['isCorrect'] ? 1 : 0;
                $questionOption->save();
            }
        } catch (Exception $error) {
            // Handle the error
            return response()->json(['error' => 'An error occurred'], 500);
        }
        return response()->json([
            'request' => $request->input(),
            'message' => 'Thêm mới thành công'
        ], 200);
    }
    public function getQuestionDetail(Question $question)
    {
        if ($question) {
            return response()->json([
                'message' => 'Request Success',
                'question' => new QuestionResource($question)
            ], 200);
        }

        return response()->json([
            'message' => 'Request Error'
        ], 401);
    }

    public function updateQuestions(Request $request, Question $question)
    {
        try {
            $question->question_type_id = $request->input('question_type_id');
            $question->question = $request->input('question');
            $question->score = $request->input('score');
            $question->multi_answer = $request->input('multi_answer') ? 1 : 0;

            if ($request->hasFile('image')) {
                $name = $request->file('image')->getClientOriginalName();

                $pathFull = 'uploads/' . date("Y/m/d");
                $path = $request->file('image')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                $question->question_image = '/storage/' . $pathFull . '/' . $name;
            }

            $question->save();
            if (
                $request->input('options_length') > 1
            ) {
                $options = json_decode($request->input('options'), true);

                foreach ($options as $option) {
                    $questionOption = new QuestionOption();
                    $questionOption->question_id = $question->id;
                    $questionOption->option_text = $option['content'];
                    $questionOption->correct = $option['isCorrect'] ? 1 : 0;
                    $questionOption->save();
                }
            }

        } catch (Exception $error) {
            // Handle the error
            return response()->json(['error' => 'An error occurred'], 500);
        }
        return response()->json([
            'request' => $request->input(),
            'message' => 'Edit thành công'
        ], 200);
    }

    public function deleteQuestion(Question $question)
    {
        try {

            $result = false;
            if ($question) {
                // Lấy danh sách các lựa chọn thuộc về câu hỏi
                $options = $question->options;

                // Xóa từng lựa chọn
                foreach ($options as $option) {
                    $option->delete();
                }

                // Tiến hành xóa câu hỏi
                $question->delete();

                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa bài câu hỏi thành công'
                ], 200);
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => true,
                'message' => 'Đã có lỗi xảy ra'
            ], 401);
        }
    }
}
