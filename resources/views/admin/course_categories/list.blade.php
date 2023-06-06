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
                            <th>Tên Loại Khóa Học</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    @php
                        \Carbon\Carbon::setLocale('vi');
                    @endphp
                    <tbody>
                        @php($i = 1)
                        @foreach ($courseCategories as $category)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->deleted_at != null)
                                        <span class="btn btn-danger btn-xs">NO</span>
                                    @else
                                        <span class="btn btn-success btn-xs">YES</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($category->updated_at == null)
                                        <span class="text-danger">Chưa đặt thời gian</span>
                                    @else
                                        {{ $category->updated_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/course-category/edit/{{ $category->id }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#"
                                        onclick="removeRow({{ $category->id }},'/admin/course-category/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $courseCategories->links() }}
            </div>
        </div>
    </section>
@endsection
