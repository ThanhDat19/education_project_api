@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <section class="section">
        <div class="card">
            <a class="btn btn-primary" href="/admin/lesson/add/{{ $course->id }}">Thêm Bài Học</a>
            <div class="card-body">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Tên Bài Học</th>
                            <th style="width: 400px">Miêu Tả</th>
                            <th>Trạng thái</th>
                            <th>Vị trí</th>
                            <th>Cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($lessons as $lesson)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $lesson->title }}</td>
                                <td>{{ $lesson->short_text }}</td>
                                <td>
                                    @if ($lesson->deleted_at != NULL)
                                        <span class="btn btn-danger btn-xs">NO</span>
                                    @else
                                        <span class="btn btn-success btn-xs">YES</span>
                                    @endif
                                </td>
                                <td>
                                   {{ $lesson->position }}
                                </td>
                                <td>
                                    @if($lesson->updated_at == NULL)
                                    <span class="text-danger">Chưa đặt thời gian</span>
                                    @else
                                    {{ $lesson->updated_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/lesson/edit/{{ $lesson->id }}/{{ $course->id }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="removeRow({{ $lesson->id }},'/admin/lesson/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $lessons->links() }}
            </div>
        </div>
    </section>
@endsection
