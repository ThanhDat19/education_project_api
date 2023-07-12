<?php

namespace App\Http\Controllers;

use App\Models\Payment;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $payments = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#8BC3AE', '#FF6384', '#36A2EB', '#FFCE56', '#8BC3AE', '#FF6384', '#36A2EB', '#FFCE56', '#8BC3AE'];

        for ($i = 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $total = 0;

            foreach ($payments as $payment) {
                if ($payment->month == $i) {
                    $total = $payment->total;
                    break;
                }
            }

            array_push($labels, $month);
            array_push($data, $total);
        }

        $datasets = [
            [
                'label' => 'Tổng số doanh (Đơn vị tính $)',
                'data' => $data,
                'backgroundColor' => $colors
            ]
        ];

        return view('admin.home', ['title' => 'Trang Chủ', 'datasets' => $datasets, 'labels' => $labels]);

    }
}
