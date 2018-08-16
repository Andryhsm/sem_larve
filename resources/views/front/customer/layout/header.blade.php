<header class="main-header">
    <!-- Logo -->
    <a href="{!! route('dashboard') !!}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="{!! url('backend/img/logo-altee-bleu.svg') !!}"> 
        </span>
    </a>
   
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- <li class="dropdown notifications-menu">
                    <a href="{!! URL::to('/admin/tickets') !!}">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning">{!! count_tickets() !!}</span>
                    </a>
                </li> -->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="" class="user-image" alt="User Image">
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="" class="img-circle" alt="User Image">
                            <p>
                               
                                {{--<small>Member since Nov. 2010</small>--}}
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{!! url(LaravelLocalization::getCurrentLocale().'/customer/customer-informations') !!}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! route('logout') !!}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
