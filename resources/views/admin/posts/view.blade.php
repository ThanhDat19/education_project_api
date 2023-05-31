@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <div class="card-body">
        <div class="mb-3">
            <label for="user">Tên bài đăng</label>
            <p class="form-control">{{ $post->name }}</p>
        </div>
        <div class="mb-3">
            <label for="user">Loại bài đăng</label>
            <p class="form-control">{{ $post->category->name }}</p>
        </div>
        <div class="form-group">
            <label for="">Ảnh bài đăng</label>
            <div id="image_show">
                <a href="{{ $post->image }}" target="_blank">
                    <img src="{{ $post->image }}" alt=""style="width: 400px; height:300px; object-fit:cover;">
                </a>
            </div>
        </div>
        <div class="mb-3">
            <label for="user">Miêu tả</label>
            <p class="form-control">{{ $post->description }}</p>
        </div>
        <div class="mb-3">
            <label for="user">Tác giả</label>
            <p class="form-control">{{ $post->user->name }}</p>
        </div>
        <div class="mb-3">
            <label for="user">Thời điểm tạo</label>
            <p class="form-control">{{ $post->updated_at->format('d/m/Y')  }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ url('admin/posts/list') }}" class="btn btn-danger ">Trở Về</a>
        </div>
    </div>
@endsection
@section('footer')

@endsection
