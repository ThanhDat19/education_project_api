<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Test;
use App\Models\Courses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'question_type_id' => 'required',
            'question' => 'required',
            'score' => 'required',
            'question_image' => 'required',
            'multi_answer' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'question_type_id' => 'required',
            'question' => 'required',
            'score' => 'required',
            'question_image' => 'required',
            'multi_answer' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $question->fill([
                "question_type_id" => $request->input('question_type_id'),
                "question" => $request->input('question'),
                "score" => $request->input('score'),
                "question_image" => $request->input('question_image'),
                "multi_answer" => $request->input('multi_answer'),
            ]);
            $question->save();
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
        $course = Courses::find($request->input('course_id'));
        $questions = null;
        if ($course) {
            $questions = Question::where('question_type_id', $course->type)->get();
        } else {
            $questions = Question::where('question_type_id', $request->input('questionTypeId'))->get();
        }

        return view('admin.questions.filter-by-type', ['questions' => $questions]);
    }
}
