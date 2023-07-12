<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComments(Request $request, User $user)
    {
        $lesson = Lesson::find($request->lesson);
        $comments = Comment::where([
            'lesson_id' => $lesson->id,
            'impolite' => 0
        ])->get();

        if ($comments) {
            return response()->json([
                'request' => $request->input(),
                "comments" => CommentResource::collection($comments)
            ], 200);
        } else {
            return response()->json([
                'request' => $request->input(),
                "comments" => null
            ], 200);
        }
    }

    public function postComments(Request $request, User $user)
    {
        try {
            // Lấy dữ liệu từ request
            $data = $request->validate([
                'author' => 'required',
                'content' => 'required|string',
                'lesson' => 'required',
                'impolite' => 'required',
            ]);

            $comment = new Comment();
            $comment->lesson_id = $data['lesson'];
            $comment->user_id = $data['author'];
            $comment->comment_body = $data['content'];
            $comment->impolite = $data['impolite'];
            $comment->save();
            return response()->json([
                'request' => $request->input(),
                "comments" => new CommentResource($comment)
            ], 200);

        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Có lỗi vui lòng thử lại',
                'request' => $request->input(),
            ], 401);
        }
    }

    public function putComments(Request $request, User $user, Comment $comment)
    {
        try {
            // Lấy dữ liệu từ request
            $data = $request->validate([
                'content' => 'required|string',
            ]);
            $comment->comment_body = $data['content'];
            $comment->save();
            return response()->json([
                'request' => $request->input(),
                "comment" => new CommentResource($comment)
            ], 200);

        } catch (\Exception $err) {
            return response()->json([
                'message' => 'Có lỗi vui lòng thử lại',
                'request' => $request->input(),
            ], 401);
        }
    }

    public function deleteComments(Request $request, User $user, Comment $comment)
    {
        try {
            $result = false;
            if ($comment) {
                $comment->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa bình luận thành công'
                ], 200);
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => true,
                'message' => 'Đã có lỗi xảy ra'
            ], 401);
        }
    }
}
