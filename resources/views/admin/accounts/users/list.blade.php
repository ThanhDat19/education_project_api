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
                            <th>Họ Tên</th>
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
                                    @else
                                        <span class="btn btn-success btn-xs">ADMIN</span>
                                    @endif
                                </td>
                                @if ($user->id != Auth::user()->id)
                                    <td>
                                        <a href="/admin/accounts/users/edit/{{ $user->id }}" class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#"
                                        onclick="removeRow({{ $user->id }},'/admin/accounts/admins/delete')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </section>
@endsection
