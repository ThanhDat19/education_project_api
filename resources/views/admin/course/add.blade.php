@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="course">Tên khóa học</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tên khóa học">
            </div>

            <div class="form-group">
                <label for="course">Loại khóa học</label>
                <select name="course_category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="course">Miêu tả</label>
                <textarea name="description" id="content" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="course">Giá</label>
                <textarea name="price" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="course">Ảnh khóa học</label>
                <input type="file" name="image_validate" class="form-control" id="upload">

                <div id="image_show" class="mt-4">

                </div>
                <input type="hidden" name="image" id="image">
            </div>

            <div class="form-group">
                <label for="course">Ngày học</label>
                <div class='input-group date'>
                    <input type='text' name="start_date" data-date-format="dd-mm-yyyy" class="form-control datepicker" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
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
            <button type="submit" class="btn btn-primary">Tạo khóa học</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
