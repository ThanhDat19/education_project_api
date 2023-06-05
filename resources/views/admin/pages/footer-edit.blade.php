@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">

            <div class="form-group">
                <label for="footer">Email</label>
                <input type="email" name="email" value="{{ $footer->email }}" class="form-control" placeholder="Nhập email">
            </div>

            <div class="form-group">
                <label for="footer">Số điện thoại</label>
                <input type="text" name="phone" value="{{ $footer->phone }}" class="form-control"
                    placeholder="Nhập số điện thoại">
            </div>

            <div class="form-group">
                <label for="footer">Đường dẫn facebook</label>
                <input type="text" name="facebook" value="{{ $footer->facebook }}" class="form-control"
                    placeholder="Nhập đường dẫn facebook">
            </div>

            <div class="form-group">
                <label for="footer">Đường dẫn youtube</label>
                <input type="text" name="youtube" value="{{ $footer->youtube }}" class="form-control"
                    placeholder="Nhập đường dẫn youtube">
            </div>

            <div class="form-group">
                <label for="footer">Đường dẫn twitter</label>
                <input type="text" name="twitter" value="{{ $footer->twitter }}" class="form-control"
                    placeholder="Nhập đường dẫn twitter">
            </div>

            <div class="form-group">
                <label for="footer">Ghi nhận</label>
                <input type="text" name="footer_credit" value="{{ $footer->footer_credit }}" class="form-control"
                    placeholder="Nhập phần ghi nhận ở chân trang">
            </div>

            <div class="form-group">
                <label for="footer">Địa chỉ</label>
                <textarea name="address" id="content" class="form-control">{{ $footer->address }}</textarea>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật trang</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
