@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <div class="row mt-2">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="fas fa-users-cog"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <a href="{{ url('admin/teacher/add') }}" class="small-box-footer">Thêm Giảng Viên<i
                                    class="fas fa-arrow-circle-right ml-2"></i></a>
                            <h6 class="font-extrabold mb-0"></h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th style="...">ID</th>
                            <th>Tên Đăng Nhập</th>
                            <th>Email</th>
                            <th>Quyền Thành Viên</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($teachers as $key => $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->roles->pluck('name')->contains('student'))
                                        <span class="btn btn-primary btn-xs">USER</span>
                                    @elseif ($user->roles->pluck('name')->contains('teacher'))
                                        <span class="btn btn-success btn-xs">TEACHER</span>
                                    @elseif ($user->roles->pluck('name')->contains('admin'))
                                        <span class="btn btn-danger btn-xs">BOSS</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/teacher/show/{{ $user->id }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- <a href="#" onclick="removeRow({{ $user->id }},'/admin/teacher/delete')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a> --}}

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $teachers->links() }}
            </div>
        </div>
    </section>
@endsection
