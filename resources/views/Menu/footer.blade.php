<footer class="container-fluid text-center">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-center">
        <h5>(Footer Menu)</h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">

            <ul class="navbar-nav justify-content-center">

                <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">home</a></li>
                @foreach ($topNavItems2 as $nav)
                    @if (!empty($nav->children[0]))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                @if ($nav->name == null)
                                    {{ $nav->title }}
                                @else
                                    {{ $nav->name }}
                                @endif
                            </a>
                            <ul class="dropdown-menu">

                                @foreach ($nav->children[0] as $child)
                                    <li>
                                        @if ($child->type == 'category')
                                            <a class="dropdown-item" href="{{ $child->slug }}">
                                                @if ($child->name == null)
                                                    {{ $child->title }}
                                                @else
                                                    {{ $child->name }}
                                                @endif
                                            </a>
                                        @elseif ($child->type == 'page')
                                            <a class="dropdown-item" href="{{ $child->slug }}">
                                                @if ($child->name == null)
                                                    {{ $child->title }}
                                                @else
                                                    {{ $child->name }}
                                                @endif
                                            </a>
                                        @elseif ($child->type == 'post')
                                            <a class="dropdown-item" href="{{ $child->slug }}">
                                                @if ($child->name == null)
                                                    {{ $child->title }}
                                                @else
                                                    {{ $child->name }}
                                                @endif
                                            </a>
                                        @elseif ($child->type == 'custom')
                                            <a class="dropdown-item" href="{{ $child->slug }}">
                                                @if ($child->name == null)
                                                    {{ $child->title }}
                                                @else
                                                    {{ $child->name }}
                                                @endif
                                            </a>
                                        @endif
                                        {{-- ======================== --}}
                                        @if (isset($child->children))
                                            @foreach ($child->children as $value)
                                                <ul class="submenu dropdown-menu">
                                                    @foreach ($value as $val)
                                                        <li>
                                                            @if ($val->type == 'category')
                                                                <a class="dropdown-item" href="{{ $val->slug }}">
                                                                    @if ($val->name == null)
                                                                        {{ $val->title }}
                                                                    @else
                                                                        {{ $val->name }}
                                                                    @endif
                                                                </a>
                                                            @elseif ($val->type == 'page')
                                                                <a class="dropdown-item" href="{{ $val->slug }}">
                                                                    @if ($val->name == null)
                                                                        {{ $val->title }}
                                                                    @else
                                                                        {{ $val->name }}
                                                                    @endif
                                                                </a>
                                                            @elseif ($val->type == 'post')
                                                                <a class="dropdown-item" href="{{ $val->slug }}">
                                                                    @if ($val->name == null)
                                                                        {{ $val->title }}
                                                                    @else
                                                                        {{ $val->name }}
                                                                    @endif
                                                                </a>
                                                            @elseif ($val->type == 'custom')
                                                                <a class="dropdown-item" href="{{ $val->slug }}">
                                                                    @if ($val->name == null)
                                                                        {{ $val->title }}
                                                                    @else
                                                                        {{ $val->name }}
                                                                    @endif
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        @endif
                                        {{-- ========================= --}}
                                    </li>
                                @endforeach

                            </ul>

                        </li>
                    @else
                        @if ($nav->type == 'category')
                            <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}">
                                    @if ($nav->name == null)
                                        {{ $nav->title }}
                                    @else
                                        {{ $nav->name }}
                                    @endif
                                </a>
                            </li>
                        @elseif ($nav->type == 'page')
                            {{-- {{ route('page/unpublish', $value->id) }} --}}
                            <li class="nav-item">
                                <a class="nav-link" href=" {{ route('pages', $nav->slug) }}"
                                    target="{{ $nav->target }}">
                                    @if ($nav->name == null)
                                        {{ $nav->title }}
                                    @else
                                        {{ $nav->name }}
                                    @endif
                                </a>
                            </li>
                        @elseif ($nav->type == 'post')
                            <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}">
                                    @if ($nav->name == null)
                                        {{ $nav->title }}
                                    @else
                                        {{ $nav->name }}
                                    @endif
                                </a>
                            </li>
                        @elseif ($nav->type == 'custom')
                            <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}">
                                    @if ($nav->name == null)
                                        {{ $nav->title }}
                                    @else
                                        {{ $nav->name }}
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div> <!-- navbar-collapse.// -->
    </nav>
</footer>
{{-- ==================== --}}

<script type="text/javascript">
    /// some script

    // jquery ready start
    $(document).ready(function() {
        // jQuery code

        //////////////////////// Prevent closing from click inside dropdown
        $(document).on('click', '.dropdown-menu', function(e) {
            e.stopPropagation();
        });

        // make it as accordion for smaller screens
        if ($(window).width() < 992) {
            $('.dropdown-menu a').click(function(e) {
                e.preventDefault();
                if ($(this).next('.submenu').length) {
                    $(this).next('.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', function() {
                    $(this).find('.submenu').hide();
                })
            });
        }

    }); // jquery end
</script>

<style type="text/css">
    @media (min-width: 992px) {
        .dropdown-menu .dropdown-toggle:after {
            border-top: .3em solid transparent;
            border-right: 0;
            border-bottom: .3em solid transparent;
            border-left: .3em solid;
        }

        .dropdown-menu .dropdown-menu {
            margin-left: 0;
            margin-right: 0;
        }

        .dropdown-menu li {
            position: relative;
        }

        .nav-item .submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .nav-item .submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu>li:hover {
            background-color: #f1f1f1
        }

        .dropdown-menu>li:hover>.submenu {
            display: block;
        }
    }

</style>
