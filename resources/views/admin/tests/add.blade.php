@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="test">Tiêu đề bài kiểm tra</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề bài kiểm tra">
            </div>

            <div class="form-group">
                <label for="test">Khóa học</label>
                <select name="course_id" class="form-control" id="course">
                    <option value="">-- Chọn khóa học --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="test">Bài học</label>
                <select name="lesson_id" class="form-control" id="lesson">

                </select>
            </div>

            <div class="form-group">
                <label for="test">Miêu tả</label>
                <textarea name="description" id="content" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="published" id="active" value="1"
                        checked="" id="active">
                    <label class="custom-control-label" for="active">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="published" id="non_active" value="0">
                    <label class="custom-control-label"for="non_active">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo bài kiểm tra</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
