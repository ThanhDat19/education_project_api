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
                            <th style="width: 50px">ID</th>
                            <th>Tiêu Đề Bài Kiểm Tra</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($tests as $test)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $test->title }}</td>
                                <td>
                                    @if ($test->published == 0)
                                        <span class="btn btn-danger btn-xs">NO</span>
                                    @else
                                        <span class="btn btn-success btn-xs">YES</span>
                                    @endif
                                </td>
                                <td>
                                    @if($test->updated_at == NULL)
                                    <span class="text-danger">Chưa đặt thời gian</span>
                                    @else
                                    {{ $test->updated_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/tests/edit/{{ $test->id }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="removeRow({{ $test->id }},'/admin/tests/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tests->links() }}
            </div>
        </div>
    </section>
@endsection
