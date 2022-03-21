@extends('layouts.app')

@section('content')
    <a class="btn btn-primary mb-2 ml-2" href="{{ url('category/create') }}">Add category</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sl = 1;
            @endphp
            @foreach ($data as $value)
                <tr>
                    <th scope="row">{{ $sl++ }}</th>
                    <td>{{ $value->cat_name }}</td>
                    <td>
                        <a href="{{ url('category/edit', $value->id) }}">Edit</a> /
                        <a href="{{ url('category/delete', $value->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
