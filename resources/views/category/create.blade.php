@extends('layouts.deshboard')

@section('content')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Category</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="POST" action="{{ route('category/store') }}">
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Category Name
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="name" class="form-control" id="mySelect" onchange="myFunction()"
                                    placeholder="category name" required="required">

                                <input type="hidden" name="title" id="titleSelect" value="" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Slug Name
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="slug" id="slugValue" value="" class="form-control"
                                    placeholder="Slug-name" required="required">
                            </div>
                            <input type="hidden" name="link" id="linkValue" value="" class="form-control">
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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @if (count($category->subcategory) > 0)
                                                @foreach ($category->subcategory as $sub)
                                                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                                    @if (count($sub->subcategory) > 0)
                                                        @include(
                                                            'newcategory.createsubcategories',
                                                            ['category' => $sub->subcategory]
                                                        )
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-5 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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
@endsection
