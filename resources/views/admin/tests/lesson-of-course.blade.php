@foreach($lessons as $lesson)
    <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
@endforeach
