@extends('layouts.deshboard')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif
    <div class="col-md-12 col-sm-12  ">
        <div class="page-title">
            <div class="title_left">
                <h3>Page Manage</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    <div class="input-group">
                        <a class="btn btn-primary mb-2 ml-2" href="{{ route('page/create') }}">Add New Page</a>
                        <input type="text" class="form-controller form-control" id="search" name="search"
                            placeholder="Search" />
                    </div>
                </div>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Page List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr>
                                <th class="column-title"> <input type="checkbox" id="checkAll"></th>
                                <th class="column-title" scope="col">Title</th>
                                <th class="column-title" scope="col">Author</th>
                                <th class="column-title" scope="col">Date</th>
                                <th class="column-title" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cat = '';
                                $userName = '';
                            @endphp
                            @foreach ($userData as $user)
                                @php
                                    $userName = $user->name;
                                @endphp
                            @endforeach
                            <form method="post" action="{{ route('page/multipledelete') }}">
                                {{ csrf_field() }}
                                <input class="btn btn-danger" type="submit" name="submit" value="Delete All" />
                                <br><br>
                                @foreach ($pages as $value)
                                    <tr>
                                        <td class="text-left">
                                            <input name='id[]' type="checkbox" id="checkAll" value="<?php echo $value->id; ?>">
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $userName }}</td>
                                        {{-- <td> {{ $value->status == 1 ? 'Publish' : 'Unpublish' }}</td> --}}
                                        <td> {{ $value->publish_at }}</td>
                                        {{-- <td width="480px" height="100px" style="overflow: hidden;">{!! $value->body !!}</td> --}}
                                        {{-- <td> <img src="{{ asset($value->image) }}" width="120px" height="100px"></td> --}}
                                        <td>
                                            @if ($value->status == 1)
                                                <a href="{{ route('page/publish', $value->id) }}"
                                                    class="btn btn-info "><i class="fa fa-arrow-circle-up"
                                                        aria-hidden="true"></i></a>
                                            @else
                                                <a href="{{ route('page/unpublish', $value->id) }}"
                                                    class="btn btn-info btn-warning">
                                                    <i class="fa fa-arrow-circle-down " aria-hidden="true"></i>
                                                </a>
                                            @endif


                                            <a href="{{ route('page/edit', $value->id) }}" class="btn btn btn-primary"><i
                                                    class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                            <a href="{{ route('page/delete', $value->id) }}"
                                                class="btn btn btn-info  btn-danger"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                    {!! $pages->links() !!}
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script language="javascript">
        // Multy Data delete
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


        // Ajex search 
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('page/search') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('table').html(data);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection
