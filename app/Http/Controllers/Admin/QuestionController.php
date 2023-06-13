<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Test;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::paginate(10);
        return view('admin.questions.list', [
            'title' => 'Danh Sách Câu Hỏi',
            'questions' => $questions
        ]);
    }

    public function create()
    {
        $questionTypes = QuestionType::all();
        return view('admin.questions.add', [
            'title' => 'Thêm Câu Hỏi',
            'questionTypes' => $questionTypes
        ]);
    }

    public function store(Request $request)
    {
        try {
            Question::create([
                "question_type_id" => $request->input('question_type_id'),
                "question" => $request->input('question'),
                "score" => $request->input('score'),
                "question_image" => $request->input('question_image'),
                "multi_answer" => $request->input('multi_answer'),
            ]);

            Session::flash('success', 'Thêm câu hỏi mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->back();
    }


    public function show(Question $question)
    {
        $questionTypes = QuestionType::all();
        return view('admin.questions.edit', [
            'title' => 'Chỉnh Sửa Câu Hỏi',
            'questionTypes' => $questionTypes,
            'question' => $question
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $question->fill([
            "question_type_id" => $request->input('question_type_id'),
            "question" => $request->input('question'),
            "score" => $request->input('score'),
            "question_image" => $request->input('question_image'),
            "multi_answer" => $request->input('multi_answer'),
        ]);
        $question->save();
        try {
            Session::flash('success', 'Cập nhật câu hỏi thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $question = Question::where('id', $request->input('id'))->first();

            if ($question) {
                $question->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa câu hỏi thành công'
                ]);
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => true,
                'message' => 'Đã có lỗi xảy ra'
            ]);
        }
    }

    public function filterByType(Request $request)
    {
        $questionTypeId = $request->input('questionTypeId');
        $questions = null;
        if ($questionTypeId) {
            $questions = Question::where('question_type_id', $questionTypeId)->get();
        } else {
            $questions = Question::all();
        }

        return view('admin.questions.filter-by-type', ['questions' => $questions]);
    }
}
