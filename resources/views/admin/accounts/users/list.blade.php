@extends('admin.main')
@section('head')
@endsection
@section('contents')
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
                        @foreach ($students as $key => $user)
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
                                    <a href="/admin/student/show/{{ $user->id }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#"
                                        onclick="removeRow({{ $user->id }},'/admin/student/studentDelete')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $students->links() }}
            </div>
        </div>
    </section>
@endsection
