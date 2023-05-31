@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="course">Tên khóa học</label>
                <input type="text" name="title" value="{{ $course->title }}" class="form-control"
                    placeholder="Nhập tên khóa học">
            </div>

            <div class="form-group">
                <label for="course">Loại khóa học</label>
                <select name="course_category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}" {{ $course->course_category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="course">Miêu tả</label>
                <textarea name="description" id="content" class="form-control">{{ $course->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="course">Giá</label>
                <textarea name="price" class="form-control">{{ $course->price }}</textarea>
            </div>

            <div class="form-group">
                <label for="course">Ảnh khóa học</label>
                <input type="file" name="image_validate" class="form-control" id="upload">
                <div id="image_show" class="mt-4">
                    <a href="{{ $course->course_image  }}" target="_blank">
                        <img src="{{ $course->course_image  }}" alt="" width="400px">
                    </a>
                </div>
                <input type="hidden" name="image" id="image" value="{{ $course->course_image }}">
            </div>

            <div class="form-group">
                <label for="course">Ngày học</label>
                <div class='input-group date'>
                    <input type='text' name="start_date" data-date-format="dd-mm-yyyy"
                        value="{{ \Carbon\Carbon::parse($course->start_date)->format('d-m-Y') }}"
                        class="form-control datepicker" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="published" id="active" value="1"
                        {{ $course->published == 1 ? 'checked=""' : '' }} id="active">
                    <label class="custom-control-label" for="active">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="published" id="non_active" value="0"
                        {{ $course->published == 0 ? 'checked=""' : '' }}>
                    <label class="custom-control-label"for="non_active">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật khóa học</button>
            <a class="btn btn-secondary" href="/admin/lesson/list/{{ $course->id }}">Quản lý bài học</a>
        </div>
    </form>
@endsection
@section('footer')
@endsection
