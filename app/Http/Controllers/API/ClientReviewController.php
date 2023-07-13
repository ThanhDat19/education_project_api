<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use App\Models\CourseStudent;
use Exception;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    public function postReview(Request $request)
    {
        try {
            $review = ClientReview::create(
                [
                    'user_id' => $request->input('user_id'),
                    'courses_id' => $request->input('course_id'),
                    'impolite' => $request->input('impolite'),
                    'star_count' => $request->input('star_count'),
                    'content' => $request->input('content'),
                ]
            );

            if ($review) {
                $studentCourse = CourseStudent::where([
                    'user_id' => $request->input('user_id'),
                    'course_id' => $request->input('course_id'),
                ])->first();

                $studentCourse->rating = $request->input('star_count');

                $studentCourse->save();
                return response()->json([
                    'request' => $request->input(),
                    'review' => $review,
                    'status' => 200
                ]);
            }
            return response()->json([
                'request' => $request->input(),
                'status' => 400
            ]);
        } catch (Exception $error) {
            return response()->json([
                'request' => $request->input(),
                'status' => 500
            ]);
        }

    }
}
