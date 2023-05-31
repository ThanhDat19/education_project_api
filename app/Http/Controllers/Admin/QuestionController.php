<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
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
        $tests = Test::all();
        return view('admin.questions.add', [
            'title' => 'Thêm Câu Hỏi',
            'tests' => $tests
        ]);
    }

    public function store(Request $request)
    {
        Question::create([
            "test_id" => $request->input('test_id'),
            "question" => $request->input('question'),
            "score" =>  $request->input('score'),
            "question_image" =>  $request->input('question_image'),
        ]);

        try {

            Session::flash('success', 'Thêm câu hỏi mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->back();
    }


    public function show(Question $question)
    {
        $tests = Test::all();
        return view('admin.questions.edit', [
            'title' => 'Chỉnh Sửa Câu Hỏi',
            'tests' => $tests,
            'question' => $question
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $question->fill([
            "test_id" => $request->input('test_id'),
            "question" => $request->input('question'),
            "score" =>  $request->input('score'),
            "question_image" =>  $request->input('question_image')
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
}
