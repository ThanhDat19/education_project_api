@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <div class="card">
        <form action="" method="post">
            @csrf
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="discount">Tạo chương trình khuyến mãi</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Nhập chương trình khuyến mãi">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="discount">Loại chương trình khuyến mãi</label>
                                        <select name="discount_types" class="form-control">
                                            <option value="1">Giảm theo %</option>
                                            <option value="2">Giảm theo giá tiền</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount">Áp dụng cho</label>
                                        <select name="categories" class="form-control" id="categories">
                                            <option value="">-- Hãy lựa chọn --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="discount">Mức giảm</label>
                                        <input type="text" name="reduction_rate" class="form-control"
                                            placeholder="Mức giảm">
                                    </div>
                                    <div class="form-group">
                                        <label for="discount">Khóa học</label>
                                        <select name="course_id" class="form-control" id="course">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="discount">Thời gian bắt đầu</label>
                                <div class='input-group date'>
                                    <input type='text' name="start_date" data-date-format="dd-mm-yyyy"
                                        class="form-control datepicker" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="discount">Thời gian kết thúc</label>
                                <div class='input-group date'>
                                    <input type='text' name="end_date" data-date-format="dd-mm-yyyy"
                                        class="form-control datepicker" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tạo giảm giá</button>
            </div>
        </form>
    </div>
@endsection
@section('footer')
@endsection
