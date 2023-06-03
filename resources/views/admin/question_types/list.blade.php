@extends('admin.main')
@section('head')
    <style>
        .type-image {
            max-width: 100px;
        }
    </style>
@endsection
@section('contents')
    <section class="section">
        <div class="card">
            <div class="card-body">
                @php
                    \Carbon\Carbon::setLocale('vi');
                @endphp

                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Tên Lĩnh Vực</th>
                            <th>Ngày cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($questionTypes as $type)
                            <tr class="type-item">
                                <td>{{ $i++ }}</td>
                                <td>{{ $type->name }}</td>
                                <td>
                                    @if ($type->updated_at == null)
                                        <span class="text-danger">Chưa đặt thời gian</span>
                                    @else
                                        {{ $type->updated_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/question-types/edit/{{ $type->id }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="removeRow({{ $type->id }},'/admin/question-types/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $questionTypes->links() }}
            </div>
        </div>
    </section>
@endsection
