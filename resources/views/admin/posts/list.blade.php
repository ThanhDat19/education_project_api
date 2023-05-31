@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <section class="section">
        <div class="card">
            <div class="card-body">

                <div class="col-md-6 mt-4">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select name="category" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary form-control">Lọc</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th style="...">ID</th>
                            <th>Tên bài đăng</th>
                            <th>Hình ảnh</th>
                            <th>Loại bài đăng</th>
                            <th>Trạng thái | Tố cáo</th>
                            <th>Cập nhật</th>
                            <th style="...">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)

                        @foreach ($posts as $key => $post)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $post->name }}</td>
                                <td><img src="{{ $post->image }}" alt="{{ $post->name }}"
                                        style="width:150px; height:150px; object-fit:cover;"></td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    @if ($post->active == 0)
                                        <span class="btn btn-danger btn-xs">NO</span>
                                    @elseif($post->active == 1)
                                        <span class="btn btn-success btn-xs">YES</span>
                                    @elseif($post->active == 2)
                                        <span class="btn btn-success btn-xs">FOUND</span>
                                    @endif
                                    <a href="{{ route('report-list', ['post' => $post->id]) }}"
                                        class="btn btn-warning btn-xs">{{ $post->report->count() }}</a>
                                </td>
                                <td>
                                    @if ($post->updated_at == null)
                                        <span class="text-danger">Chưa đặt thời gian</span>
                                    @endif
                                    {{ $post->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    @if ($post->active == 0)
                                        <a href="#" onclick="allowPost({{ $post->id }},'/admin/posts/allow')"
                                            class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                    <a href="/admin/posts/view/{{ $post->id }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#"
                                        onclick="removeRow({{ $post->id }},'/admin/posts/destroy')"class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
