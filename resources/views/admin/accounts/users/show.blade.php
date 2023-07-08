@extends('admin.main')
@section('head')
    <style>
        .course-image {
            max-width: 100px;
        }
    </style>
@endsection
@section('contents')
    <div class="card-body">
        <div class="mb-3">
            @if ($user->avarta)
                <img src="{{ $user->avarta }}" width="20%">
            @else
                <img src="/storage/images/avatar/default-avatar.png" width="20%">
            @endif
        </div>
        <div class="mb-3">
            <label for="user">Email</label>
            <p class="form-control">{{ $user->email }}</p>
        </div>

        <div class="mb-3">
            <label for="user">Họ và tên</label>
            <p class="form-control">{{ $user->name }}</p>
        </div>

        <div class="mb-3">
            <label for="user">Danh sách khóa học đăng ký</label>

            <section class="section">
                <div class="card">
                    <div class="card-body">
                        @php
                            \Carbon\Carbon::setLocale('vi');
                            $latestTime = null;
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

                                                <?php
                                                $latestTime = $latestTime === null || $course->updated_at > $latestTime ? $course->updated_at : $latestTime;
                                                ?>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @if ($latestTime !== null)
                                <input type="hidden" id="last-time" name="last_time"
                                    value="{{ $latestTime->diffForHumans() }}">
                            @endif
                        </table>
                        {{ $courses->links() }}
                    </div>
                </div>
            </section>
        </div>

        <div class="card-footer">
            <a href="{{ url('admin/student/list') }}" class="btn btn-danger ">Trở Về</a>
        </div>
    </div>
@endsection
