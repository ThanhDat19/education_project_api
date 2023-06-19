<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QuestionTypeController extends Controller
{
    public function index()
    {
        $questionTypes = QuestionType::paginate(10);
        return view('admin.question_types.list', [
            'title' => 'Danh Sách Lĩnh Vực',
            'questionTypes' => $questionTypes
        ]);
    }

    public function create()
    {
        return view('admin.question_types.add', [
            'title' => 'Thêm Lĩnh Vực',
        ]);
    }

    public function store(Request $request)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            QuestionType::create([
                "name" => $request->input('name'),
            ]);

            Session::flash('success', 'Thêm lĩnh vực mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }

        return redirect()->back();
    }


    public function show(QuestionType $type)
    {
        return view('admin.question_types.edit', [
            'title' => 'Chỉnh Sửa Lĩnh Vực',
            'type' => $type
        ]);
    }

    public function update(Request $request, QuestionType $type)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $type->fill([
                "name" => $request->input('name'),
            ]);
            $type->save();

            Session::flash('success', 'Cập nhật lĩnh vực thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $type = QuestionType::where('id', $request->input('id'))->first();

            if ($type) {
                $type->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa lĩnh vực thành công'
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
