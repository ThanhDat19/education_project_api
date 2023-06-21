@foreach($types as $type)
    <option value="{{ $type->id }}">{{ $type->name }}</option>
@endforeach
