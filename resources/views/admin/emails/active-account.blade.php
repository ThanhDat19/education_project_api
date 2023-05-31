<div style="width:600px; margin:0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{ $user->name }}</h2>
        <p>Bạn đã đăng ký tài khoản của hệ thống chúng tôi</p>
        <p>Để có thể tiếp tục sử dụng tài khoản và đăng nhập vào hệ thống, Bạn vui lòng nhấn nút kích hoạt tài khoản bên
            dưới!
        </p>
        <a href="{{ route('active-account', ['user' => $user->id, 'token' => $user->token]) }}"
            style="display: inline-block; background:green; color: #fff; padding: 7px 25px; boder-radius: 4px; font-weight:bold">Kích hoạt
            tài khoản
        </a>
    </div>
</div>
