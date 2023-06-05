@extends('admin.main')
@section('head')
    <style>
        .course-image {
            max-width: 100px;
        }
    </style>
@endsection
@section('contents')
    <section class="section">
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="course-type">Loại khóa học:</label>
                        <select id="course-type" class="form-control">
                            <option value="">Tất cả</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                            <!-- Thêm các loại khác vào đây -->
                        </select>

                        <button id="filter-new" class="btn btn-primary">Lọc khóa học mới tạo</button>
                    </div>
                    <div class="col-md-6">
                        <label for="min-price">Giá tối thiểu:</label>
                        <input type="number" id="min-price-input" class="form-control">
                        <label for="max-price">Giá tối đa:</label>
                        <input type="number" id="max-price-input" class="form-control">
                        <button id="filter-price" class="btn btn-primary mt-2">Lọc theo giá</button>
                    </div>
                </div>
                @php
                    \Carbon\Carbon::setLocale('vi');
                @endphp

                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên Khóa Học</th>
                            <th>Loại khóa học</th>
                            <th>Giá khóa học</th>
                            <th>Trạng thái</th>
                            <th>Ngày cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($courses as $course)
                            <tr class="course-item" data-type="{{ $course->course_category_id }}"
                                data-price="{{ $course->price }}">
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if ($course->course_image)
                                        <img src="{{ asset($course->course_image) }}" alt="Course Image"
                                            class="course-image">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->category->name }}</td>
                                <td>{{ $course->price }}</td>
                                <td>
                                    @if ($course->published == 0)
                                        <span class="btn btn-danger btn-xs">NO</span>
                                    @else
                                        <span class="btn btn-success btn-xs">YES</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($course->updated_at == null)
                                        <span class="text-danger">Chưa đặt thời gian</span>
                                    @else
                                        {{ $course->updated_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/course/edit/{{ $course->id }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="removeRow({{ $course->id }},'/admin/course/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $courses->links() }}
            </div>
        </div>
    </section>
@endsection
