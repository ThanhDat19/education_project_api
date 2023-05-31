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
                            <a href="{{ url('admin/accounts/admins/add') }}" class="small-box-footer">Thêm Thành Viên Admin<i
                                    class="fas fa-arrow-circle-right"></i></a>
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
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 0)
                                        <span class="btn btn-primary btn-xs">USER</span>
                                    @elseif ($user->role == 1)
                                        <span class="btn btn-success btn-xs">ADMIN</span>
                                    @elseif ($user->role == 2)
                                        <span class="btn btn-success btn-xs">ADMIN</span>
                                        <span class="btn btn-danger btn-xs">BOSS</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->id != Auth::user()->id && $user->role != 2)
                                        <a href="/admin/accounts/admins/edit/{{ $user->id }}" class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    @if(Auth::user()->role == 2 && $user->id != Auth::user()->id)
                                    <a href="#"
                                        onclick="removeRow({{ $user->id }},'/admin/accounts/admins/delete')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </section>
@endsection
