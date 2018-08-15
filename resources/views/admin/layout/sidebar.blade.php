<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! $user->getProfileImage() !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! $user->first_name !!} {!! $user->last_name !!}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Admin et Abonnée -->
            @if(check_user_access(['dashboard']))
            <li class="active treeview">
                <a href="{!! route('dashboard') !!}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @endif

            <!-- Admin -->
            @if(check_user_access(['orders','order-status.index']))
            <li class="treeview {{ set_active(['admin/order-status','admin/order-status/*','admin/sales/*']) }}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Sales</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class=" {{ set_active(['admin/sales/*']) }}">
                            <a href="#">
                                <i class="fa fa-circle-o"></i>
                                All orders
                            </a>
                        </li>
                        @if(check_user_access('order-status.index'))
                        <li class="{{ set_active(['admin/order-status','admin/order-status/*']) }}">
                            <a href="{!! Url('/admin/order-status') !!}"><i class="fa fa-circle-o"></i> Status Manager</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

            <!-- Admin -->
            @if(check_user_access(['product_billed','orders']))
            <li class="treeview {{ set_active(['admin/statistics/sales','admin/statistics/sales/*']) }}">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Statistics</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            @endif

            <!-- Admin -->
            @if(check_user_access(['page.index','email-template.index']))
            <li class="treeview {{ set_active(['admin/page','admin/page/*','admin/banner','admin/banner/*','admin/coupon','admin/coupon/*','admin/faq','admin/faq/*'])}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Training + FAQ</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access('page.index'))
                    <li class="{{ set_active(['admin/page','admin/page/*']) }}"><a
                                href="{!! URL::to('/admin/page') !!}"><i class="fa fa-circle-o"></i> Page Manager</a>
                    </li>
                    @endif
                    @if(check_user_access(['faq.index', 'faq.create', 'faq.edit']))
                    <li class="treeview {{ set_active(['admin/faq','admin/faq/*']) }}">
                        <a href="{!! url('admin/faq') !!}"><i class="fa fa-circle-o"></i><span> FAQ Manager</span></a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- Admin -->
            @if(check_user_access(['blog.index','blog-category.index']))
                <li class="treeview {{ set_active(['admin/blog','admin/blog/*','admin/blog-category','admin/blog-category/*']) }}">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Blog </span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(check_user_access('blog-category.index'))
                            <li class=""><a
                                        href=""><i class="fa fa-circle-o"></i> Blog Category</a>
                            </li>
                        @endif
                        @if(check_user_access('blog.index'))
                            <li class=""><a
                                        href=""><i class="fa fa-circle-o"></i> Blog Post</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Admin -->
            @if(check_user_access(['priorities.index', 'statuses.index', 'categories.index', 'product-rating.index']))
                <li class="treeview {{ set_active(['admin/tickets/priorities/*','admin/tickets/priorities', 'admin/tickets/statuses/*', 'admin/tickets/statuses', 'admin/tickets/categories', 'admin/tickets/categories/*', 'admin/tickets','admin/tickets/lists']) }}">
                <a href="#">
                    <i class="fa fa-ticket"></i>
                    <span>Comm. & Tickets</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access('tickets.index'))
                        <li class="{{ set_active(['admin/tickets','admin/tickets/lists']) }}"><a
                                    href="{!! URL::to('/admin/tickets') !!}"><i class="fa fa-circle-o"></i> Tickets</a>
                        </li>
                    @endif
                     @if(check_user_access('priorities.index'))
                        <li class="{{ set_active(['admin/tickets/priorities/*','admin/tickets/priorities']) }}"><a
                                    href="{!! URL::to('/admin/tickets/priorities') !!}"><i class="fa fa-circle-o"></i> Ticket priorities</a>
                        </li>
                    @endif
                    @if(check_user_access('statuses.index'))
                        <li class="{{ set_active(['admin/tickets/statuses','admin/tickets/statuses/*']) }}"><a
                                    href="{!! URL::to('/admin/tickets/statuses') !!}"><i class="fa fa-circle-o"></i> Ticket status</a>
                        </li>
                    @endif
                    @if(check_user_access('categories.index'))
                        <li class="{{ set_active(['admin/tickets/categories','admin/tickets/categories/*']) }}"><a
                                    href="{!! URL::to('/admin/tickets/categories') !!}"><i class="fa fa-circle-o"></i> Ticket categories</a>
                        </li>
                    @endif
                </ul>
            </li>
            @endif

            <!-- Admin -->
            @if(check_user_access(['customer.index','store.index','administrator','role.index']))
            <li class="treeview {{ set_active(['admin/role','admin/role/*','admin/customer','admin/customer/*','admin/store','admin/store/*','admin/administrator','admin/administrator/*']) }}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Accounts</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access('customer.index'))
                    <li class="{{ set_active(['admin/customer','admin/customer/*']) }}"><a
                                href="{!! URL::to('admin/customer') !!}"><i class="fa fa-circle-o"></i> Partners</a>
                    </li>
                    @endif
                    @if(check_user_access('administrator'))
                    <li class="{{ set_active(['admin/administrator','admin/administrator/*']) }}"><a
                                href="{!! URL::to('admin/administrator') !!}"><i class="fa fa-circle-o"></i> Admin system</a>
                    </li>
                    @endif
                    @if(check_user_access('role.index'))
                    <li class="{{ set_active(['admin/role','admin/role/*']) }}"><a href="{!! URL::to('admin/role') !!}"><i
                                    class="fa fa-circle-o"></i> Role manager</a></li>
                    @endif  
                </ul>
            </li>
            @endif

            <!-- Admin -->
            @if(check_user_access(['email-template.index','update_setting', 'setting_update']))
            <li class="treeview {{ set_active(['admin/system','admin/system/*','admin/meta_og','admin/meta_og/*', 'admin/epartner','admin/epartner/*','admin/email-template','admin/email-template/*']) }}">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span>System</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access(['update_setting', 'setting_update']))
                        <li class="{{ set_active(['admin/system','admin/system/*']) }}"><a
                                    href="{!! URL::to('/admin/system') !!}"><i class="fa fa-circle-o"></i> Meta & OG</a>
                        </li>
                    @endif
                    @if(check_user_access('email-template.index'))
                        <li class="{{ set_active(['admin/email-template','admin/email-template/*']) }}"><a
                                href="{!! URL::to('/admin/email-template') !!}"><i class="fa fa-circle-o"></i> Email/SMS
                            Template</a></li>
                    @endif
                </ul>
            </li>
             @endif

             <!-- Abonnée -->
            <li class="treeview {{ set_active(['admin/attribute','admin/attribute/*','admin/attribute-set','admin/attribute-set/*','admin/brand','admin/brand/*','admin/category','admin/category/*','admin/product','admin/product/*','admin/brand-tag-translation','admin/brand-tag-translation/*']) }}">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Keywords trends</span>
                    </a>
            </li>

            @if(check_user_access(['training']))
            <li class="treeview {{ set_active(['training'])}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Training</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @foreach(get_training_pages() as $page)   
                    <li class="{{ set_active([$page->url->target_url]) }}"><a
                                href="{!! url(LaravelLocalization::getCurrentLocale().'/'.$page->url->target_url) !!}"><i class="fa fa-circle-o"></i> {!! $page->english->page_title !!}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endif
            <li class="treeview {{ set_active(['*/customer/tickets']) }}">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Support + FAQ </span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    
                        <li class="{{ set_active(['*/admin/tickets']) }}"><a
                                    href="{!! url('/admin/help-faq') !!}"><i class="fa fa-circle-o"></i> Support</a>
                        </li>
                    
                        <li class=""><a
                                    href=""><i class="fa fa-circle-o"></i> FAQ</a>
                        </li>
                    
                </ul>
            </li>
            
            <li class="treeview {{ set_active(['admin/customer-informations']) }}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Accounts</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    
                    <li class="{{ set_active(['admin/customer-informations']) }}"><a
                                href="{!! route('profile') !!}"><i class="fa fa-circle-o"></i> Profil</a>
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
