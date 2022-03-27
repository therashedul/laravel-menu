@foreach ($category as $cats)
    <option>{{ $cats->name }}</option>
    <a href="{{ url('category/edit', $cats->id) }}">Edit</a> /
    <a href="{{ url('category/delete', $cats->id) }}">Delete</a>
@endforeach
