<section class="section">
    <div class="card">
        <div class="card-body">
            @php
                \Carbon\Carbon::setLocale('vi');
            @endphp
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>
                            {{-- <input type="checkbox" id="checkAll"> --}}
                        </th>
                        <th style="width: 50px">STT</th>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Điểm số</th>
                        <th>Nhiều đáp án</th>
                        <th>Thời gian tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach ($questions as $question)
                        <tr class="question-item">
                            <td>
                                <input type="checkbox" name="questions[]" value="{{ $question->id }}">
                            </td>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
