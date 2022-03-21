@extends('layouts.deshboard')

@section('content')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="container">

        <form action="{{ route('page/update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $page->id }}">
            <div class="row">
                <div class="col-md-9 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Add New Page</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <div class=" form-group has-feedback">
                                <input type="text" name="name" id="mySelect" onchange="myFunction()"
                                    value="{{ $page->name }}" class="form-control" placeholder="Add Title">
                                <input type="hidden" name="title" id="titleSelect" value="{{ $page->name }}"
                                    class="form-control">
                            </div>

                            <input class="form-check-input" name="userId" type="hidden" value="{{ $user['id'] }}" checked>
                            <div class="form-group has-feedback">
                                <input type="hidden" name="slug" id="slugValue" value="{{ $page->slug }}" />
                            </div>
                            <div class="form-group has-feedback">
                                <input type="hidden" name="link" id="linkValue" value="{{ $page->link }}" />
                                Permalink: <span id="parmalink">{{ $page->link }}</span>
                            </div>
                            <div class=" form-group has-feedback">
                                <textarea name="content" class="my-editor form-control" id="my-editor" cols="50"
                                    rows="20">{!! $page->content !!}</textarea>
                            </div>
                        </div>
                    </div>
                    {{-- Exarpt field --}}
                    {{-- <div class="x_panel">
                        <div class="x_title">
                            <h3>Exarpt</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class=" form-group has-feedback">
                                <textarea name="excerpt" class=" form-control" cols="10" rows="5"></textarea>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-md-3 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Parent page</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="item form-group">
                                Parent Page
                                <select class="custom-select" name="parent_id" id="inputGroupSelect01">
                                    <option selected value="0">Choose...</option>
                                    @if ($pages)
                                        @foreach ($pages as $parent)
                                            <option {{ $parent->id == $page->parent_id ? 'selected=""' : '' }}
                                                value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Feature Image</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group ">
                                <input type="file" name="image" />
                                {{-- <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only form-control" id="inputImage" name="file"
                                            accept="image/*">
                                        <span class="docs-tooltip" data-toggle="tooltip" title="Import image ">
                                            <span class="fa fa-upload"></span>
                                        </span>
                                    </label> --}}
                                {{-- <input type="file" name="image" class="form-control"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Publish / Unpublish</h3>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="">
                                <label>
                                    <input type="hidden" value="0" {{ $page->status == 0 ? 'checked' : '' }}
                                        class="js-switch" name="status">
                                    <input type="checkbox" value="1" {{ $page->status == 1 ? 'checked' : '' }}
                                        class="js-switch" name="status">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Template</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col ">
                                <div class="x_content">
                                    <div class="item form-group">
                                        Template Page
                                        {{-- <select class="custom-select" name="publish_at" id="inputGroupSelect01">
                                            <option selected value="1">Choose...</option>
                                        </select> --}}




                                        <select class="custom-select" name="template" id="inputGroupSelect01">
                                            @if ($pages)
                                                <option {{ $page->template == 0 ? 'selected=""' : '' }} value="0">
                                                    Default </option>
                                                <option {{ $page->template == 1 ? 'selected=""' : '' }} value="1"> Full
                                                    Width Page </option>
                                                <option {{ $page->template == 2 ? 'selected=""' : '' }} value="2">
                                                    Sidebar Page </option>
                                            @endif
                                        </select>










                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Publish</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col">
                                <div class="form-group">
                                    <div class='input-group date'>
                                        {{-- <input type="text" id="datetime" class="form-control" name="publish_at"
                                                value=" "> --}}
                                        <input type='text' id='datetimepicker' class="form-control" name="publish_at"
                                            value="{{ date('Y-m-d H:i', time()) }}" />
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    // var today = new Date();
                                    // document.getElementById("datetime").value = today.getFullYear() +
                                    //     '-' + ('0' + (today.getMonth() + 1)).slice(-2) +
                                    //     '-' + ('0' + today.getDate()).slice(-2) +
                                    //     ' ' + ('0' + today.getHours()).slice(-2) +
                                    //     ':' + ('0' + today.getMinutes()).slice(-2) +
                                    //     ':' + ('0' + today.getSeconds()).slice(-2);
                                    $(function() {
                                        $('#datetimepicker').datetimepicker({
                                            format: 'yyyy-mm-dd hh:ii',
                                            autoclose: true,
                                            todayHighlight: true,
                                        });
                                    });
                                </script>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            function myFunction() {
                var strng = document.getElementById("mySelect").value;
                var APP_URL = {!! json_encode(url('/')) !!}
                const spt = strng.split(" ");
                var imp = spt.join('-');
                document.getElementById("linkValue").value = APP_URL + '/' + imp;
                document.getElementById("parmalink").innerHTML = APP_URL + '/' + imp;
                document.getElementById("slugValue").value = imp;
            }
        </script>
    </div>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script>
@endsection
