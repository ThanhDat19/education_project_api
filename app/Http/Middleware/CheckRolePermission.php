<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!$user) {
            Session::flash('error', 'Hãy đăng nhập để tiếp tục');
            return redirect()->back();
        }

        // Kiểm tra vai trò của người dùng
        $roles = $user->roles;
        $hasRole = $roles->pluck('name')->contains($role);

        if (!$hasRole) {
            Auth::guard('web')->logout();
            Session::flash('error', 'Người dùng không đủ quyền');
            return redirect()->back();
        }

        return $next($request);
    }
}
