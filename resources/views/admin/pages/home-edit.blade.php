@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">

            <div class="form-group">
                <label for="home">Tiêu đề trang</label>
                <input type="text" name="home_title" value="{{ $home->home_title }}" class="form-control"
                    placeholder="Nhập tiêu đề trang">
            </div>

             <div class="form-group">
                <label for="home">Tiêu đề phụ của trang</label>
                <input type="text" name="home_subtitle" value="{{ $home->home_subtitle }}" class="form-control"
                    placeholder="Nhập tiêu đề phụ của trang">
            </div>

            <div class="form-group">
                <label for="home">Miêu tả công nghệ</label>
                <textarea name="tech_description" class="form-control">{{ $home->tech_description }}</textarea>
            </div>

            <div class="form-group">
                <label for="home">Miêu tả video</label>
                <textarea name="video_description" id="content" class="form-control">{{ $home->video_description }}</textarea>
            </div>

            <div class="form-group">
                <label for="home">Video url</label>
                <input type="text" name="video_url" value="{{ $home->video_url }}" class="form-control"
                    placeholder="Nhập video url">
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
