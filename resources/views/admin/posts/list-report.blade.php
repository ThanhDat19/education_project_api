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
                            <th>Tên người tố cáo</th>
                            <th>Lý do</th>
                            <th>Loại bài đăng</th>
                            <th>Cập nhật</th>
                            <th style="...">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)

                        @foreach ($posts as $key => $post)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>

                                    {{  $post->showDetail() }}

                                </td>
                                <td>
                                    {{ $post->post->category->name }}
                                </td>
                                <td>
                                    @if ($post->updated_at == null)
                                        <span class="text-danger">Chưa đặt thời gian</span>
                                    @endif
                                    {{ $post->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="#"
                                        onclick="removeRow({{ $post->id }},'/admin/posts/report/destroy')"class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
