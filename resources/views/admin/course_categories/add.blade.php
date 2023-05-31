@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="course">Tên loại khóa học</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên loại khóa học">
            </div>

            <div class="form-group">
                <label for="course">Tiêu đề loại khóa học</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề loại">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo loại khóa học</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
