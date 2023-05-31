<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\TestResultAnswer;
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
        $userID = $data['user_id'];
        $answers = $data['answers'];

        $totalScore = 0;


        foreach ($answers as $answer) {
            $questionId = $answer['question_id'];
            $correct = $answer['correct'];
            $score = $answer['score'];

            // Kiểm tra câu trả lời đúng và cộng điểm tương ứng
            if ($correct) {
                $totalScore += $score; // Cộng điểm của câu trả lời đúng
            } else {
                $totalScore += 0; // Không cộng điểm cho câu trả lời sai
            }
        }

        TestResult::create([
            'test_id' => $testId,
            'user_id' => $userID,
            'test_result' => $totalScore
        ]);

        //Lấy kết quả kiểm tra mới thêm vào csdl
        $testResult = TestResult::where([
            'test_id' => $testId,
            'user_id' => $userID,
        ])->first();

        $data = '';
        //Thêm chi tiết kết quả kiểm tra
        foreach ($answers as $answer) {

            $questionId = $answer['question_id'];
            $correct = $answer['correct'];
            $score = $answer['score'];
            $optionId = $answer['option_id'];

            // Kiểm tra câu trả lời đúng và cộng điểm tương ứng
            $data = TestResultAnswer::create([
                'test_result_id' => $testResult->id,
                'question_id' => $questionId,
                'question_option_id' => $optionId,
                'correct' => $correct,
                'score' => $score,
            ]);
        }
        // Trả về kết quả xử lý
        return response()->json([
            'data' => $data,
            'total_score' => $totalScore
        ], 200);

    }
}
