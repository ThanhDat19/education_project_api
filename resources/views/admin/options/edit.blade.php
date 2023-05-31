@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="option">Nội dung câu hỏi: {{ $question->question }}</label>
        </div>

        <div class="form-group">
            <label for="option">Nội dung lựa chọn</label>
            <input type="text" name="option_text" value="{{ $option->option_text }}" class="form-control" placeholder="Nhập nội dung lựa chọn">
        </div>
        <div class="form-group">
            <label for="lesson">Đáp án đúng</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="correct" id="active" value="1"
                    {{ $option->correct == 1 ? 'checked=""' : '' }} id="active">
                <label class="custom-control-label" for="active">Đúng</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="correct" id="non_active" value="0"
                    {{ $option->correct == 0 ? 'checked=""' : '' }}>
                <label class="custom-control-label"for="non_active">Sai</label>
            </div>
        </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật lựa chọn</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
