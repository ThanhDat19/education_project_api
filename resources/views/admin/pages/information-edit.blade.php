@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="home">Thông tin</label>
                <textarea name="about" class="form-control">{{ $information->about }}</textarea>
            </div>
            <div class="form-group">
                <label for="home">Chính sách hoàn tiền</label>
                <textarea name="refund" class="form-control">{{ $information->refund }}</textarea>
            </div>
            <div class="form-group">
                <label for="home">Điều khoản và điều kiện</label>
                <textarea name="terms" class="form-control">{{ $information->terms }}</textarea>
            </div>
            <div class="form-group">
                <label for="home">Chính sách bảo mật</label>
                <textarea name="privacy" class="form-control">{{ $information->privacy }}</textarea>
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
