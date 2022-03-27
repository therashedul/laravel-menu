     {{-- {{ $menus }} --}}
     <div class="col-md-3 left_col">
         <div class="left_col scroll-view">
             <div class="navbar nav_title" style="border: 0;">
                 <a href="{{ url('/') }}" class="site_title"><span>Dashaboard</span></a>
             </div>
             <div class="clearfix"></div>
             <br />
             <!-- sidebar menu -->
             <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                 <div class="menu_section">

                     <ul class="nav side-menu">
                         <li><a href="{{ url('/') }}"> Home </a> </li>
                         <li><a> Post<span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="{{ route('post/index') }}">Mange Post</a></li>
                                 <li><a href="{{ route('post/create') }}">Add Post</a></li>
                             </ul>
                         </li>
                         <li><a>Category <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="{{ route('category/index') }}">Mange Category</a></li>
                                 <li><a href="{{ route('category/create') }}">Add Category</a></li>
                             </ul>
                         </li>
                         <li><a>Page <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="{{ route('page/index') }}">Mange Page</a></li>
                                 <li><a href="{{ route('page/create') }}">Add Page</a></li>
                             </ul>
                         </li>
                         <li><a>Setting <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a>Menu<span class="fa fa-chevron-down"></span></a>
                                     <ul class="nav child_menu">
                                         <li><a href="{{ url('manage-menus') }}">Mange Menu</a></li>
                                     </ul>
                                 </li>
                             </ul>
                         </li>
                     </ul>
                 </div>
             </div>
             <!-- /sidebar menu -->

             <!-- /menu footer buttons -->
             <div class="sidebar-footer hidden-small">
                 <a data-toggle="tooltip" data-placement="top" title="Settings">
                     <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                 </a>
                 <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                     <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                 </a>
                 <a data-toggle="tooltip" data-placement="top" title="Lock">
                     <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                 </a>
                 <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                     <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                 </a>
             </div>
             <!-- /menu footer buttons -->
         </div>
     </div>
