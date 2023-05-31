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
                            <th>Tên Khóa Học</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $course->title }}</td>
                                <td>
                                    @if ($course->published == 0)
                                        <span class="btn btn-danger btn-xs">NO</span>
                                    @else
                                        <span class="btn btn-success btn-xs">YES</span>
                                    @endif
                                </td>
                                <td>
                                    @if($course->updated_at == NULL)
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
