@extends('layouts.deshboard')

@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Category List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="clearfix"></div>
                <a class="btn btn-primary mb-2 ml-2" href="{{ route('category/create') }}">Add category</a>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($categories as $value)
                            <tr>
                                <th scope="row">{{ $sl++ }}</th>
                                <td>{{ $value->name }}
                                    &nbsp; &nbsp;
                                    @if ($value->status == 1)
                                        <a style="margin-left: 80%" href="{{ route('category/publish', $value->id) }}"
                                            class="btn btn-info "><i class="fa fa-arrow-circle-up"
                                                aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{ route('category/unpublish', $value->id) }}"
                                            class="btn btn-info btn-warning">
                                            <i class="fa fa-arrow-circle-down " aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('category/edit', $value->id) }}" class="btn btn btn-primary"><i
                                            class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                    <a href="{{ route('category/delete', $value->id) }}"
                                        class="btn btn btn-info  btn-danger"><i class="fa fa-trash-o"
                                            aria-hidden="true"></i></a>
                                    <br>
                                    @if (count($value->subcategory) > 0)
                                        @foreach ($value->subcategory as $sub)
                                            @if ($sub->status == 1)
                                                <span style="margin-left: 25px;">{{ $sub->name }}</span>
                                                &nbsp; &nbsp;
                                                <a style="margin-left: 80%"
                                                    href="{{ route('category/publish', $sub->id) }}"
                                                    class="btn btn-info "><i class="fa fa-arrow-circle-up"
                                                        aria-hidden="true"></i></a>
                                            @else
                                                <a href="{{ route('category/unpublish', $sub->id) }}"
                                                    class="btn btn-info btn-warning">
                                                    <i class="fa fa-arrow-circle-down " aria-hidden="true"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('category/edit', $sub->id) }}"
                                                class="btn btn btn-primary"><i class="fa fa-pencil-square"
                                                    aria-hidden="true"></i></a>
                                            <a href="{{ route('category/delete', $sub->id) }}"
                                                class="btn btn btn-info  btn-danger"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i></a>


                                            <br>
                                            @if (count($sub->subcategory) > 0)
                                                @include('category.subcategories', [
                                                    'category' => $sub->subcategory,
                                                ])
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
@endsection
