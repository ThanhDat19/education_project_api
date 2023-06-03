@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">

            <div class="form-group">
                <label for="question_type">Tên lĩnh vực</label>
                <input type="text" name="name" value="{{ $type->name }}" class="form-control"
                    placeholder="Nhập tên lĩnh vực">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật lĩnh vực</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
