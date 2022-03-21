@extends('layouts.app')

@section('content')

    <form action="{{ route('category/update') }}" method="post">
        @csrf
        <div class="form-group">
            <labe>Category Name</label>
                <input type="hidden" name="id" value="{{ $category->id }}">
                <input type="text" name="cat_name" value="{{ $category->cat_name }}" class="form-control"
                    placeholder="category name">
                <input type="text" name="slug" name="slug" id="slugValue" value="{{ $category->slug }}" />

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
