@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <div class="card-body">
        <form action="{{url('admin/accounts/admins/add')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="user">Họ và tên</label>
                <input type="text" name="name" class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="user">Email</label>
                <input type="email" name="email" class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="user">Mật Khẩu</label>
                <input type="password" name="password" class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="user">Xác Nhận</label>
                <input type="password" name="password_confirm" class="form-control"/>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tạo Tài Khoản</button>
                <a href="{{ url('admin/accounts/admins/list') }}" class="btn btn-danger ">Trở Về</a>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
@endsection
@section('footer')

@endsection
