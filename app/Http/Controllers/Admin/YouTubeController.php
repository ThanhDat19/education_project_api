<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_YouTube;
use Illuminate\Http\Request;

class YouTubeController extends Controller
{
    public function getVideoDuration($video_id)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setScopes([
            Google_Service_YouTube::YOUTUBE_READONLY,
        ]);

        // Khởi tạo YouTube service objectcomposer require google/apiclient:^2.12.1
        $youtube = new Google_Service_YouTube($client);

        // Gửi yêu cầu để lấy thông tin video
        $videoId = $video_id; // Thay thế YOUR_VIDEO_ID bằng ID của video muốn lấy duration
        $video = $youtube->videos->listVideos('contentDetails', ['id' => $videoId])->getItems()[0];

        $duration = $video->getContentDetails() ;

        return $duration;
    }
}
