@extends('admin.main')
@section('head')
@endsection
@section('contents')
    <section class="section">
        <div class="card">
            <a class="btn btn-primary" href="/admin/options/add/{{ $question->id }}">Thêm lựa chọn</a>
            <div class="card-body">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($options as $option)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $option->option_text }}</td>
                                <td>
                                    @if ($option->correct != 0)
                                        <span class="btn btn-success btn-xs">ĐÚNG</span>
                                    @else
                                        <span class="btn btn-danger btn-xs">SAI</span>
                                    @endif
                                </td>
                                <td>
                                    @if($option->updated_at == NULL)
                                    <span class="text-danger">Chưa đặt thời gian</span>
                                    @else
                                    {{ $option->updated_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/options/edit/{{ $option->id }}/{{ $question->id }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="removeRow({{ $option->id }},'/admin/options/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $options->links() }}
            </div>
        </div>
    </section>
@endsection
