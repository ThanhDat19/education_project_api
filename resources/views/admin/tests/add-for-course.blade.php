@extends('admin.main')
@section('head')
    <style>
        .question-image {
            max-width: 100px;
        }
    </style>
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="test">Tiêu đề bài kiểm tra</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề bài kiểm tra">
            </div>

            <input type="hidden" name="course_id" class="form-control" value="{{ $course->id }}">


            <div class="form-group">
                <label for="test">Bài học</label>
                <select name="lesson_id" class="form-control" id="lesson">
                    <option value="">-- Chọn bài học --</option>
                    @foreach ($course->lessons as $lesson)
                        <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="test">Miêu tả</label>
                <textarea name="description" id="content" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="question_type">Loại câu hỏi:</label>
                <select id="question-type-select" name="type" class="form-control">
                    <option value="">--Chọn Lĩnh Vực--</option>
                    @foreach ($questionTypes as $questionType)
                        <option value="{{ $questionType->id }}">{{ $questionType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="question-list">
                <!-- List of questions based on selected question type will be displayed here -->
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
