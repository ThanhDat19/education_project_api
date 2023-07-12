<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function list()
    {
        $comments = Comment::paginate(10);
        return view('admin.comments.list', [
            'title' => 'Danh Sách Bình Luận',
            'comments' => $comments
        ]);
    }

    public function delete(Request $request)
    {
        try {
            $result = false;
            $comment = Comment::where('id', $request->input('id'))->first();

            if ($comment) {
                $comment->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa bình luận thành công'
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
