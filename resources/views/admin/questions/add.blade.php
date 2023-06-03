@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="test">Lĩnh vực</label>
                <select name="question_type_id" class="form-control" id="course">
                    <option value="">-- Chọn lĩnh vực --</option>
                    @foreach ($questionTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="question">Nội dung câu hỏi</label>
                <input type="text" name="question" class="form-control" placeholder="Nhập nội dung câu hỏi">
            </div>
            <div class="form-group">
                <label for="question">Điểm số</label>
                <input type="number" name="score" class="form-control" placeholder="Nhập điểm số">
            </div>

            <div class="form-group">
                <label for="question">Ảnh câu hỏi</label>
                <input type="file" name="image_validate" class="form-control" id="upload">

                <div id="image_show" class="mt-4">

                </div>
                <input type="hidden" name="question_image" id="image">
            </div>

            <div class="form-group">
                <label for="question">Nhiều đáp án</label>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="multi_answer" id="active" value="1"
                        checked="" id="active">
                    <label class="custom-control-label" for="active">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="multi_answer" id="non_active" value="0">
                    <label class="custom-control-label"for="non_active">Không</label>
                </div>
            </div>
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo câu hỏi</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
