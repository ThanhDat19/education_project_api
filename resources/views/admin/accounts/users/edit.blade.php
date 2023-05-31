@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <div class="card-body">
        <div class="mb-3">
            <label for="user">Email</label>
            <p class="form-control">{{ $user->email }}</p>
        </div>
        <div class="mb-3">
            <label for="user">Thời điểm tạo tài khoản</label>
            <p class="form-control">{{ $user->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="mb-3">
            <label for="user">Quyền tài khoản</label>
            <select class="form-control" name="role" disabled>
                <option value="1"{{$user->role == 1?'selected': ''}}>Admin</option>
                <option value="0"{{$user->role == 0?'selected': ''}}>User</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="user">Tên thành viên</label>
            <p class="form-control">{{ $user->name }}</p>
        </div>

        <div class="mb-3">
            <label for="user">SĐT</label>
            <p class="form-control">{{ $user->phone }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ url('admin/accounts/users/list') }}" class="btn btn-danger ">Trở Về</a>
        </div>
    </div>
    <!-- /.card-body -->
@endsection
@section('footer')

@endsection
