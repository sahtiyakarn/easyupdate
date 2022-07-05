<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('admin_dashboard') }}" class="site_title"><i class="fa fa-paw"></i>
                <span>Easy Update!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    @if (Auth::guard('admin')->user()->is_admin == '2')
                        <li><a href="{{ route('branch') }}"><i class="fa fa-home"></i> Branch</a>
                        </li>
                    @endif
                    <li><a href="{{ route('staff') }}"><i class="fa fa-home"></i> Staff</a>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Admission <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admissionlist') }}">Admission List</a></li>
                            <li><a href="{{ route('admission') }}">New Admisson</a></li>
                            <li><a href="form_validation.html">Form Validation</a></li>
                            <li><a href="form_wizards.html">Form Wizard</a></li>
                            <li><a href="form_upload.html">Form Upload</a></li>
                            <li><a href="form_buttons.html">Form Buttons</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="general_elements.html">General Elements</a></li>
                            <li><a href="media_gallery.html">Media Gallery</a></li>
                            <li><a href="typography.html">Typography</a></li>
                            <li><a href="icons.html">Icons</a></li>
                            <li><a href="glyphicons.html">Glyphicons</a></li>
                            <li><a href="widgets.html">Widgets</a></li>
                            <li><a href="invoice.html">Invoice</a></li>
                            <li><a href="inbox.html">Inbox</a></li>
                            <li><a href="calendar.html">Calendar</a></li>
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
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('admin_profile_photo/' . $profile_photo) }}"
                            alt="">{{ $admin_name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:;"> Profile</a>
                        <a class="dropdown-item" href="javascript:;">
                            <span class="badge bg-red pull-right">50%</span>
                            <span>Settings</span>
                        </a>
                        <form method="get" action="{{ route('admin.logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                    class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </form>
                        <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                            data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                        <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                            aria-labelledby="navbarDropdown1">
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    <span class="image"><img src="{{ asset('assets/images/img.jpg') }}"
                                            alt="Profile Image" /></span>
                                    <span>
                                        <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                    </span>
                                    <span class="message">
                                        Film festivals used to be do-or-die moments for movie
                                        makers.
                                        They
                                        were
                                        where...
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    <span class="image"><img src="{{ asset('assets/images/img.jpg') }}"
                                            alt="Profile Image" /></span>
                                    <span>
                                        <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                    </span>
                                    <span class="message">
                                        Film festivals used to be do-or-die moments for movie
                                        makers.
                                        They
                                        were
                                        where...
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    <span class="image"><img src="{{ asset('assets/images/img.jpg') }}"
                                            alt="Profile Image" /></span>
                                    <span>
                                        <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                    </span>
                                    <span class="message">
                                        Film festivals used to be do-or-die moments for movie
                                        makers.
                                        They
                                        were
                                        where...
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    <span class="image"><img src="{{ asset('assets/images/img.jpg') }}"
                                            alt="Profile Image" /></span>
                                    <span>
                                        <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                    </span>
                                    <span class="message">
                                        Film festivals used to be do-or-die moments for movie
                                        makers.
                                        They
                                        were
                                        where...
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <div class="text-center">
                                    <a class="dropdown-item">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
