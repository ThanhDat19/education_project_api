<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\HomePage;
use App\Models\Information;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homeList()
    {
        //get Home page
        $home = HomePage::first();
        //get Information
        $information = Information::first();
        //get About
        $footer = Footer::first();
        return view('admin.pages.list', [
            'title' => 'Quản Lý Trang',
            'home' => $home,
            'information' => $information,
            'footer' => $footer
        ]);
    }

    public function homeShow(HomePage $home)
    {
        return view('admin.pages.home-edit', [
            'title' => 'Cập Nhật Trang Chủ',
            'home' => $home
        ]);
    }

    public function homeEdit(Request $request, HomePage $home)
    {
        try {
            $home->fill([
                'home_title' => $request->input('home_title'),
                'home_subtitle' => $request->input('home_subtitle'),
                'tech_description' => $request->input('tech_description'),
                'video_description' => $request->input('video_description'),
                'video_url' => $request->input('video_url'),
            ]);
            $home->save();
            toastr()->success('Cập nhật trang chủ thành công');
            // Session::flash('success', 'Cập nhật trang chủ thành công');
        } catch (\Exception $err) {
            // Session::flash('error', 'Có lỗi vui lòng thử lại');
            toastr()->error('Có lỗi vui lòng thử lại');

        }
        return redirect()->route('pages.list');
    }

    public function footerShow(Footer $footer)
    {
        return view('admin.pages.footer-edit', [
            'title' => 'Cập Nhật Footer',
            'footer' => $footer
        ]);
    }

    public function footerEdit(Request $request, Footer $footer)
    {
        try {
            $footer->fill([
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'facebook' => $request->input('facebook'),
                'youtube' => $request->input('youtube'),
                'twitter' => $request->input('twitter'),
                'footer_credit' => $request->input('footer_credit'),
            ]);
            $footer->save();
            // Session::flash('success', 'Cập nhật footer thành công');
            toastr()->success('Cập nhật footer thành công!');
        } catch (\Exception $err) {
            // Session::flash('error', 'Có lỗi vui lòng thử lại');
            toastr()->error('Có lỗi vui lòng thử lại');
        }
        return redirect()->route('pages.list');
    }

    public function informationShow(Information $information)
    {
        return view('admin.pages.information-edit', [
            'title' => 'Cập Nhật Thông Tin',
            'information' => $information
        ]);
    }

    public function informationEdit(Request $request, Information $information)
    {
        try {
            $information->fill([
                'about' => $request->input('about'),
                'refund' => $request->input('refund'),
                'terms' => $request->input('terms'),
                'privacy' => $request->input('privacy'),
            ]);
            $information->save();
            // Session::flash('success', 'Cập nhật footer thành công');
            toastr()->success('Cập nhật thông tin thành công!');
        } catch (\Exception $err) {
            // Session::flash('error', 'Có lỗi vui lòng thử lại');
            toastr()->error('Có lỗi vui lòng thử lại');
        }
        return redirect()->route('pages.list');
    }
}
