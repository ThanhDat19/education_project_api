<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\Courses;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function list()
    {
        $discounts = Discount::paginate(10);
        return view('admin.discounts.list', [
            'title' => 'Danh Sách Giảm Giá',
            'discounts' => $discounts,
        ]);
    }

    public function add()
    {
        $categories = CourseCategory::all();
        return view('admin.discounts.add', [
            'title' => 'Thêm giảm giá',
            'categories' => $categories,
        ]);
    }

    public function getCourse(Request $request)
    {
        $category = $request->input('category');

        $courses = Courses::where('course_category_id', $category)->get();

        return view('admin.discounts.course-of-category', [
            'courses' => $courses
        ]);
    }

    public function store(Request $request)
    {
        try {

            $timestamp = Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->timestamp;
            $startDate = DateTime::createFromFormat('U', $timestamp);
            $timestamp = Carbon::createFromFormat('d-m-Y', $request->input('end_date'))->timestamp;
            $endDate = DateTime::createFromFormat('U', $timestamp);
            $discount = null;
            $course = Courses::find($request->input('course_id'));
            if (($request->input('discount_types') == 2)) {
                if (($course->price - $request->input('reduction_rate')) > 0) {
                    $discount = Discount::create([
                        'name' => $request->input('name'),
                        'discount_types' => $request->input('discount_types'),
                        'reduction_rate' => $request->input('reduction_rate'),
                        'course_id' => $request->input('course_id'),
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                    ]);
                } else {
                    Session::flash('error', 'Thêm giảm giá thất bại! Mức giảm lớn hơn giá cơ bản');
                    return redirect()->back();
                }
            } else {
                if ($request->input('reduction_rate') >= 10 && $request->input('reduction_rate') <= 100) {
                    $discount = Discount::create([
                        'name' => $request->input('name'),
                        'discount_types' => $request->input('discount_types'),
                        'reduction_rate' => $request->input('reduction_rate'),
                        'course_id' => $request->input('course_id'),
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                    ]);
                } else {
                    Session::flash('error', 'Thêm giảm giá thất bại! Mức giảm không hợp lệ (10% - 100%)');
                    return redirect()->back();
                }

            }


            if ($discount) {
                Session::flash('success', 'Thêm giảm giá thành công');
            } else {
                Session::flash('error', 'Thêm giảm giá thất bại');
            }
        } catch (Exception $error) {
            Session::flash('error', 'Thêm giảm giá thất bại');
        }
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        try {
            $result = false;
            $discount = Discount::where('id', $request->input('id'))->first();

            if ($discount) {
                $discount->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa giảm giá thành công'
                ]);
            }
        } catch (Exception $error) {
            return response()->json([
                'error' => true,
                'message' => 'Đã có lỗi xảy ra'
            ]);
        }
    }
}
