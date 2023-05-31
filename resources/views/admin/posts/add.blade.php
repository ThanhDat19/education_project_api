@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label for="post">Tên bài đăng</label>
                <input type="text" name="name" class="form-control"
                    placeholder="Nhập tên bài đăng">
            </div>

            <div class="form-group">
                <label for="post">Loại bài đăng</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="post">Mô tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="post">Mô tả chi tiết</label>
                <textarea name="content" id="content" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="">Ảnh bài đăng</label>
                <input type="file"  name="image_validate" class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="image" id="image">
            </div>

            {{-- <div class="form-group">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="active" id="active" value="1"
                        checked="" id="active">
                    <label class="custom-control-label" for="active">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="active" id="non_active" value="0">
                    <label class="custom-control-label"for="non_active">Không</label>
                </div>
            </div> --}}
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo bài đăng</button>
        </div>
    </form>
@endsection
@section('footer')

@endsection
