@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="lesson">Tiêu đề bài học</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề bài học">
            </div>
            <div class="form-group">
                <label for="lesson">Video url</label>
                <input type="text" name="video_url" class="form-control" placeholder="Nhập video url">
            </div>
            <div class="form-group">
                <label for="lesson">Miêu tả</label>
                <textarea name="short_text" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="lesson">Nội dung</label>
                <textarea name="full_text" id="content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="lesson">Vị trí</label>
                <input type="text" name="position" class="form-control" placeholder="Nhập vị trí">
            </div>
            <div class="form-group">
                <label for="lesson">Miễn phí</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="free_lesson" id="active" value="1"
                        checked="" id="active">
                    <label class="custom-control-label" for="active">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="free_lesson" id="non_active" value="0">
                    <label class="custom-control-label"for="non_active">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm bài học</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
