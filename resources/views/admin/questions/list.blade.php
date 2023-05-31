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
                            <th>Nội dung câu hỏi</th>
                            <th>Điểm số</th>
                            <th>Cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($questions as $question)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $question->question }}</td>
                                <td>
                                    {{ $question->score }}
                                </td>
                                <td>
                                    @if($question->updated_at == NULL)
                                    <span class="text-danger">Chưa đặt thời gian</span>
                                    @else
                                    {{ $question->updated_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/questions/edit/{{ $question->id }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="removeRow({{ $question->id }},'/admin/questions/destroy')"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $questions->links() }}
            </div>
        </div>
    </section>
@endsection
