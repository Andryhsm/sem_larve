<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            
            <li class="active treeview">
                <a href="{!! url(LaravelLocalization::getCurrentLocale().'/customer/get-dashboard') !!}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            
                <li class="treeview {{ set_active(['admin/attribute','admin/attribute/*','admin/attribute-set','admin/attribute-set/*','admin/brand','admin/brand/*','admin/category','admin/category/*','admin/product','admin/product/*','admin/brand-tag-translation','admin/brand-tag-translation/*']) }}">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Keywords trends</span>
                    </a>
                </li>
            
            <li class="treeview {{ set_active(['admin/page','admin/page/*','admin/banner','admin/banner/*','admin/coupon','admin/coupon/*','admin/special-product','admin/special-product/*','admin/faq','admin/faq/*'])}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Training</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            
                <li class="treeview {{ set_active(['admin/blog','admin/blog/*','admin/blog-category','admin/blog-category/*']) }}">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Support + FAQ </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        
                            <li class="{{ set_active(['*/customer/tickets']) }}"><a
                                        href="{!! url(LaravelLocalization::getCurrentLocale().'/customer/tickets') !!}"><i class="fa fa-circle-o"></i> Support</a>
                            </li>
                        
                            <li class=""><a
                                        href=""><i class="fa fa-circle-o"></i> FAQ</a>
                            </li>
                        
                    </ul>
                </li>
            
            <li class="treeview {{ set_active(['admin/role','admin/role/*','admin/customer','admin/customer/*','admin/store','admin/store/*','admin/administrator','admin/administrator/*', 'admin/stripe_account', 'admin/stripe_account/*']) }}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Accounts</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    
                    <li class="{{ set_active(['*/customer/customer-informations']) }}"><a
                                href="{!! url(LaravelLocalization::getCurrentLocale().'/customer/customer-informations') !!}"><i class="fa fa-circle-o"></i> Profil</a>
                    </li>
                    
                    <li class="{{ set_active(['admin/store','admin/store/*']) }}"><a
                                href=""><i class="fa fa-circle-o"></i> Sub-accounts</a>
                    </li>
                    
                    
                </ul>
            </li>
           

            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>