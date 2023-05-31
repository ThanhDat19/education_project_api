<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use App\Models\Lesson;
use App\Models\Test;
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
        return response()->json(
            ["data" => $request->input()]
        );
    }
}
