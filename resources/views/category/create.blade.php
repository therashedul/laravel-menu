@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('category/store') }}">
        @csrf
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="cat_name" class="form-control" placeholder="Category name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
