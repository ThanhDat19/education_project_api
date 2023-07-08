<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseStudent;
use Exception;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use ConsoleTVs\Charts\Facades\Charts;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $customMessages = [
            'required' => 'Trường :attribute là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), [
            'paymentID' => 'required',
            'payerID' => 'required',
            'payerEmail' => 'required',
            'amount' => 'required',
            'currency' => 'required',
            'paymentStatus' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Lỗi xác thực.',
                'data' => $validator->errors()
            ]);
        }

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
            $getPayment = Payment::where('payment_id', $request->input('paymentID'))->first();

            CourseStudent::create([
                'course_id' => $request->input('courseID'),
                'user_id' => $request->input('userID'),
                'payment_id' => $getPayment->id,
                'payment_status' => $request->input('paymentStatus')
            ]);

            return response()->json([
                'message' => 'Thanh toán đã được ghi và lưu thành công.',
                'data' => $getPayment
            ]);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Lỗi thanh toán.',
                'data' => $error
            ]);
        }
    }

}
