@foreach($courses as $course)
    <option value="{{ $course->id }}">{{ $course->title }}</option>
@endforeach
