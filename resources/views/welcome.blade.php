<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 450px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }

        /* =======================
         */
        @media all and (min-width: 992px) {

            .sidebar li {
                position: relative;
            }

            .sidebar li .submenu {
                display: none;
                position: absolute;
                left: 100%;
                top: -7px;
                min-width: 240px;
            }

            [dir=rtl] .sidebar li .submenu {
                right: 100%;
                left: auto;
            }

            .sidebar li:hover {
                background: var(--bs-light);
            }

            .sidebar li:hover>.submenu {
                display: block;
            }

        }

        /* ============ desktop view .end// ============ */


        /* ============ small devices ============ */
        @media (max-width: 991px) {

            .sidebar .submenu,
            .sidebar .dropdown-menu {
                position: static !important;
                margin-left: 0.7rem;
                margin-right: 0.7rem;
                margin-bottom: .5rem;
            }

        }

        /* ============ small devices .end// ============ */


        .sidebar .nav-link {
            font-weight: 500;
            color: var(--bs-dark);
        }

        .sidebar .nav-link:hover {
            background: var(--bs-light);
            color: var(--bs-primary);
        }

    </style>
</head>

<body class="antialiased">

    <div class="relative flex items-top">
        @if (Route::has('login'))
            <div class="top-0 right-0 px-6 py-4 sm:block fl">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    @php
        $menu = DB::table('menus')
            ->get()
            ->toArray();
        // echo '<pre>';
        // print_r($menu);
    @endphp



    @if (isset($menu[0]) ? $menu[0]->location == 1 : '')
        @include('menu.header')
    @else
        <a href="{{ url('/') }}/manage-menus" style="text-align: center;
    display: block;
    font-size: 22px;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: underline;
    color: red;"> Add Header Menu</a>
    @endif
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                @if (isset($menu[2]) ? $menu[2]->location == 3 : '')
                    @include('menu.sidebar')
                @else
                    <a href="{{ url('/') }}/manage-menus" style="text-align: center;
    display: block;
    font-size: 22px;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: underline;
    color: red;">Add Sidebar Menu</a>
                @endif
            </div>
            <div class="col-sm-10 text-left">
                <h1>Welcome</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <hr>
                <h3>Test</h3>
                <p>Lorem ipsum...</p>
            </div>

        </div>
    </div>

    @if (isset($menu[1]) ? $menu[1]->location == 2 : '')
        @include('menu.footer')
    @else
        <a href="{{ url('/') }}/manage-menus" style="text-align: center;
    display: block;
    font-size: 22px;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: underline;
    color: red;">Add Footer Menu</a>
    @endif



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
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

</body>

</html>
