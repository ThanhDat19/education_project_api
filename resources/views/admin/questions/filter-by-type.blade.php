<div class="container">
    <div class="row">
        @foreach ($questions as $question)
            <div class="card" style="width: 18rem; margin-right: 2rem">

                <img class="card-img-top" src="{{ asset($question->question_image) }}" alt="{{ $question->question }}">
                <div class="card-body">
                    <h5 class="card-title"> {{ $question->question }}</h5>
                    <p class="card-text">Điểm số: {{ $question->score }}</p>
                </div>
                <div class="card-footer">
                    <label for="">Chọn câu hỏi</label>
                    <input type="checkbox" name="questions[]" value="{{ $question->id }}">
                    <div class="">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="active" value="1"
                                {{ $question->multi_answer == 1 ? 'checked=""' : '' }} id="active">
                            <label class="custom-control-label" for="active">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="non_active" value="0"
                                {{ $question->multi_answer == 0 ? 'checked=""' : '' }}>
                            <label class="custom-control-label"for="non_active">Không</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
