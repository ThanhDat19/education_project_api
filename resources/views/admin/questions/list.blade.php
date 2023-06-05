@extends('admin.main')
@section('head')
    <style>
        .question-image {
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
                            <th style="width: 50px">STT</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Điểm số</th>
                            <th>Nhiều đáp án</th>
                            <th>Thời gian cập nhật</th>
                            <th style="width: 150px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($questions as $question)
                            <tr class="question-item">
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if ($question->question_image)
                                        <img src="{{ asset($question->question_image) }}" alt="Question Image"
                                            class="question-image">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->score }}</td>
                                <td>{{ $question->multi_answer ? 'Có' : 'Không' }}</td>
                                <td>{{ $question->updated_at->diffForHumans() }}</td>
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
