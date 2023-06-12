<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
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

    public function getResult(User $user, Test $test)
    {
        $testResult = TestResult::where([
            'user_id' => $user->id,
            'test_id' => $test->id,
        ])->first();
        return response()->json([
            'result' => $testResult,
        ], 200);
    }

    public function teacherGetTests(Request $request, User $user)
    {
        $perPage = 6; // Number of tests per page
        $page = $request->page; // Current page

        $courses = $user->courses; // Get the list of courses for the user
        $tests = [];

        foreach ($courses as $course) {
            foreach ($course->lessons as $lesson) {
                foreach ($lesson->tests as $test) {
                    $testData = new TestResource($test);
                    $questions = $test->questions->map(function ($question) {
                        return new QuestionResource($question);
                    });

                    $testData['questions'] = $questions;

                    $tests[] = $testData;
                }
            }
        }

        $paginatedTests = array_slice($tests, ($page - 1) * $perPage, $perPage);
        $totalTests = count($tests);
        $totalPages = ceil($totalTests / $perPage);

        return response()->json([
            'tests' => $paginatedTests,
            'total_pages' => $totalPages,
            'courses' => $courses,
            'user' => $user->id
        ], 200);
    }

    public function teacherPostTests(Request $request)
    {
        try {
            // Lấy dữ liệu từ request
            $data = $request->validate([
                'title' => 'required|string',
                'course_id' => 'required|integer',
                'lesson_id' => 'required|integer',
                'description' => 'required|string',
            ]);

            // Tạo bài kiểm tra mới
            $test = Test::create([
                'title' => $data['title'],
                'course_id' => $data['course_id'],
                'lesson_id' => $data['lesson_id'],
                'description' => $data['description'],
                'published' => 0,
            ]);

            $test->save();

        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Thêm bài kiểm tra mới thất bại'
            ], 401);
        }
    }

    public function teacherDeleteTest(Test $test)
    {
        try {
            $result = false;
            if ($test) {
                $test->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa bài kiểm tra thành công'
                ], 200);
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => true,
                'message' => 'Đã có lỗi xảy ra'
            ], 401);
        }
    }

    public function teacherUpdateTest(Request $request, Test $test)
    {



        try {
            // Lấy dữ liệu từ request
            $data = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'selectedQuestions' => 'required|array',
            ]);

            $test->fill([
                'title' => $data['title'],
                'description' => $data['description'],
            ]);
            $test->save();

            // Cập nhật danh sách câu hỏi
            $questions = $request->input('selectedQuestions', []);
            $test->questions()->sync($questions);
            return response()->json([
                'message' => 'Cập nhật bài kiểm tra thành công',
                'request' => $request->input(),
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Có lỗi vui lòng thử lại',
                'request' => $request->input(),
            ], 401);
        }
    }
}
