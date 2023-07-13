<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use App\Models\CourseStudent;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    public function list()
    {
        $reviews = ClientReview::paginate(10);

        return view('admin.review.list', [
            'title' => 'Danh sách đánh giá',
            'reviews' => $reviews
        ]);
    }

    public function delete(Request $request)
    {
        $result = false;
        $review = ClientReview::where('id', $request->input('id'))->first();
        $studentCourse = CourseStudent::where([
            'course_id' => $review->courses_id,
            'user_id' => $review->user_id
        ])->first();
        $studentCourse->rating = null;
        $studentCourse->save();
        try {

            if ($review) {

                $review->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa đánh giá thành công'
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
