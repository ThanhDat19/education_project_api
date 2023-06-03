@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <form action="" method="post">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="question_types">Lĩnh vực</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên lĩnh vực">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo lĩnh vực</button>
        </div>
    </form>
@endsection
@section('footer')
@endsection
