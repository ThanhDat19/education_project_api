<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionOption;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OptionController extends Controller
{
    public function index(Question $question)
    {
        $options = QuestionOption::where('question_id', $question->id)->paginate(10);
        return view('admin.options.list', [
            'title' => 'Danh Sách Lựa Chọn (Câu hỏi: ' . $question->question . ')',
            'options' => $options,
            'question' => $question
        ]);
    }

    public function create(Question $question)
    {
        return view('admin.options.add', [
            'title' => 'Thêm Lựa Chọn',
            'question' => $question
        ]);
    }

    public function store(Request $request, Question $question)
    {
        QuestionOption::create([
            'question_id' => $question->id,
            'option_text' => $request->input('option_text'),
            'correct' => $request->input('correct'),
        ]);

        try {

            Session::flash('success', 'Thêm lựa chọn mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->route('question.options', ['question' => $question->id]);
    }


    public function show(QuestionOption $option, Question $question)
    {
        return view('admin.options.edit', [
            'title' => 'Chỉnh Sửa Lựa Chọn',
            'option' => $option,
            'question' => $question
        ]);
    }

    public function update(Request $request, QuestionOption $option, Question $question)
    {
        try {
            $option->fill([
                'question_id' => $question->id,
                'option_text' => $request->input('option_text'),
                'correct' => $request->input('correct'),
            ]);
            $option->save();
            Session::flash('success', 'Cập nhật lựa chọn thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->route('question.options', ['question' => $question->id]);
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $option = QuestionOption::where('id', $request->input('id'))->first();

            if ($option) {
                $option->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa lựa chọn thành công'
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
