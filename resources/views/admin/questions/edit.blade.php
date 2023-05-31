@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="test">Bài kiểm tra</label>
                <select name="test_id" class="form-control" id="course">
                    <option value="">-- Chọn bài kiểm tra --</option>
                    @foreach ($tests as $test)
                        <option value="{{ $test->id }}" {{ $test->id == $question->test_id? "selected": "" }}>{{ $test->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="question">Nội dung câu hỏi</label>
                <input type="text" name="question" class="form-control" value="{{ $question->question }}" placeholder="Nhập nội dung câu hỏi">
            </div>
            <div class="form-group">
                <label for="question">Điểm số</label>
                <input type="number" name="score" class="form-control" value="{{ $question->score }}" placeholder="Nhập điểm số">
            </div>

            <div class="form-group">
                <label for="question">Ảnh câu hỏi</label>
                <input type="file" name="image_validate" class="form-control" id="upload">
                <div id="image_show" class="mt-4">
                    <a href="{{ $question->question_image  }}" target="_blank">
                        <img src="{{ $question->question_image  }}" alt="" width="400px">
                    </a>
                </div>
                <input type="hidden" name="question_image" id="image" value="{{ $question->question_image }}">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật câu hỏi</button>
            <a class="btn btn-secondary" href="/admin/options/list/{{ $question->id }}">Quản lý lựa chọn</a>
        </div>
    </form>
@endsection
@section('footer')
@endsection
