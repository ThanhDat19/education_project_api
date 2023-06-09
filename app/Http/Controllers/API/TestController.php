<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\TestResultAnswer;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getTest(Lesson $lesson)
    {
        $test = Test::where('lesson_id', $lesson->id)->first();
        return new TestResource($test);
    }

    public function takeTest(Request $request)
    {

        $data = $request->input();

        // Xử lý dữ liệu và tính điểm
        $testId = $data['test_id'];
        $userId = $data['user_id'];
        $answers = $data['answers'];

        $totalScore = 0;

        foreach ($answers as $answer) {
            $questionId = $answer['question_id'];
            $multiAnswer = $answer['multi_answer'];
            $optionChoose = $answer['option_choose'];

            $isCorrect = true;

            if ($multiAnswer) {
                // Xử lý cho câu hỏi cho phép chọn nhiều đáp án
                foreach ($optionChoose as $option) {
                    if ($option['checked'] && !$option['correct']) {
                        $isCorrect = false;
                        break;
                    }
                }
            } else {
                // Xử lý cho câu hỏi chỉ cho phép chọn một đáp án
                $selectedOption = reset($optionChoose);
                if (!$selectedOption['checked'] || !$selectedOption['correct']) {
                    $isCorrect = false;
                }
            }

            if ($isCorrect) {
                $totalScore += $answer['score'];
            }
        }

        // Lưu thông tin kết quả kiểm tra vào bảng TestResult
        $testResult = new TestResult();
        $testResult->test_id = $testId;
        $testResult->user_id = $userId;
        $testResult->test_result = $totalScore;
        $testResult->save();

        // Lưu từng câu trả lời vào bảng TestResultAnswer
        foreach ($data['answers'] as $answer) {
            $testResultAnswer = new TestResultAnswer();
            $testResultAnswer->test_result_id = $testResult->id;
            $testResultAnswer->question_id = $answer['question_id'];
            $testResultAnswer->score = $answer['score'];

            // Kiểm tra nếu có lựa chọn được chọn (checked) thì lưu vào bảng
            if (isset($answer['option_choose']) && !empty($answer['option_choose'])) {
                foreach ($answer['option_choose'] as $option) {
                    if ($option['checked']) {
                        $testResultAnswer->question_option_id = $option['option_id'];
                        $testResultAnswer->correct = $option['correct'];
                    }
                }
            }

            $testResultAnswer->save();
        }

        // Trả về kết quả xử lý
        return response()->json([
            'data' => $data,
            'total_score' => $totalScore
        ], 200);

    }

    public function getResult(User $user, Test $test){
        $testResult = TestResult::where([
            'user_id'=> $user->id,
            'test_id'=> $test->id,
        ])->first();
        return response()->json([
            'result' => $testResult,
        ], 200);
    }
}
