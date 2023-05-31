<div style="width:600px; margin:0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{ $user->name }}</h2>
        <p>Email này giúp bạn lấy lại mật khẩu đã quên</p>
        <p>Bạn vui lòng nhấn nút kích hoạt tài khoản bên
            dưới!
        </p>
        <a href="{{ route('forgot-pass', ['user' => $user->id, 'token' => $user->token]) }}"
            style="display: inline-block; background:green; color: #fff; padding: 7px 25px; boder-radius: 4px; font-weight:bold">Thay đổi mật khẩu
        </a>
    </div>
</div>
