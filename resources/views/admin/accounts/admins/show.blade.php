@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <div class="card-body">
        <div class="mb-3">
            <img src="/storage/images/avatar/default-avatar.png" width="20%">
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
            <label for="user">Danh sách khóa học</label>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Loại</th>
                                    {{-- <th>Trạng thái</th>
                                    <th>Lĩnh vực</th>
                                    <th>Số lượng bài học</th> --}}
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($course as $key => $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $user->title }}</td>
                                        <td>
                                            @if($user->pluck('course_category_id')->contains('1'))
                                                 <span >Lập trình web</span>
                                            @elseif($user->pluck('course_category_id')->contains('2'))
                                                 <span >Lập trình di động</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </section>
        </div>

        <div class="card-footer">
            <a href="{{ url('admin/teacher/list') }}" class="btn btn-danger ">Trở Về</a>
        </div>
    </div>
@endsection
