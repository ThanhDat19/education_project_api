<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function onSelectTitle()
    {
        $result = HomePage::select('home_title', 'home_subtitle')->get();
        return $result;
    }

    public function onSelectVideo()
    {
        $result = HomePage::select('video_description', 'video_url')->get();
        return $result;
    }

    public function onSelectTotal()
    {
        $result = HomePage::select('total_student', 'total_course', 'total_review')->get();
        return $result;
    }

    public function onSelectTech()
    {
        $result = HomePage::select('tech_description')->get();
        return $result;
    }
}
