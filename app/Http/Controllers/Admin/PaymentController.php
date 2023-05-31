<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseStudent;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        try {
            // Lưu thông tin thanh toán vào cơ sở dữ liệu
            $payment = new Payment();
            $payment->payment_id = $request->input('paymentID');
            $payment->payer_id = $request->input('payerID');
            $payment->payer_email = $request->input('payerEmail');
            $payment->amount = $request->input('amount');
            $payment->currency = $request->input('currency');
            $payment->payment_status = $request->input('paymentStatus');
            $payment->save();

            // Tạo liên kết giữa khóa học và học viên
            $getPayMent = Payment::where('payment_id', $request->input('paymentID'))->first();

            CourseStudent::create([
                'course_id' => $request->input('courseID'),
                'user_id' =>  $request->input('userID'),
                'payment_id' => $getPayMent->id,
                'payment_status' => $request->input('paymentStatus')
            ]);
            return response()->json([
                'message' => 'Payment captured and saved successfully.',
                'data' => $getPayMent
            ]);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Payment Error.',
                'data' => $error
            ]);
        }

    }
}
