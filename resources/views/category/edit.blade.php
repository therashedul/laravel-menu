@extends('layouts.deshboard')

@section('content')

    <form action="{{ route('category/update') }}" method="post">
        @csrf

        <input type="hidden" name="id" value="{{ $cat->id }}">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Category</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Category Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="name" value="{{ $cat->name }}" id="mySelect"
                                        onchange="myFunction()" class="form-control" placeholder="Category name"
                                        required />
                                    <input type="hidden" name="title" id="titleSelect" value="{{ $cat->name }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Slug Name
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="slug" value="{{ $cat->slug }}" id="slugValue"
                                        class="form-control" placeholder="Category slug" required />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Permalink
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" name="link" value="{{ $cat->link }}" id="linkValue"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Select Parent
                                    Category<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="custom-select" name="parent_id" id="inputGroupSelect01">
                                        <option selected value="0">Choose...</option>
                                        @if ($categories)
                                            @foreach ($categories as $category)
                                                <option {{ $category->id == $cat->parent_id ? 'selected=""' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-5 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
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
                                // document.getElementById("parmalink").innerHTML = APP_URL + '/' + imp;
                                document.getElementById("slugValue").value = imp;
                                document.getElementById("titleSelect").value = strng;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
