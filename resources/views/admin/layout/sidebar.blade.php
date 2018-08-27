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
        <hr>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Admin et Abonnée -->
            @if(check_user_access(['dashboard','dashboard_partner']))
            <li class="active treeview">
                <a href="{!! ($user->type==1) ? route('dashboard') : route('dashboard_partner') !!}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
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
                            <li class="{{ set_active(['admin/blog-category/*','admin/blog-category']) }}"><a
                                        href="{!! URL::to('/admin/blog-category') !!}"><i class="fa fa-circle-o"></i> Blog Category</a>
                            </li>
                        @endif
                        @if(check_user_access('blog.index'))
                            <li class="{{ set_active(['admin/blog/*','admin/blog']) }}"><a
                                        href="{!! URL::to('/admin/blog') !!}"><i class="fa fa-circle-o"></i> Blog Post</a>
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
            @if(check_user_access(['customer.index','store.index','administrator','role.index','adwords_api.index']))
            <li class="treeview {{ set_active(['admin/role','admin/role/*','admin/customer','admin/customer/*','admin/store','admin/store/*','admin/administrator','admin/administrator/*','partner/adwords_api','partner/adwords_api/*']) }}">
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
                    @if(check_user_access('adwords_api.index'))
                    <li class="{{ set_active(['partner/adwords_api','partner/adwords_api/*']) }}">
                        <a href="{!! route('adwords_api.index') !!}"><i class="fa fa-circle-o"></i> API Google</a>
                    </li>
                    @endif
                    @if(check_user_access('profile'))
                    <li class="{{ set_active(['admin/profile/*', 'admin/profile']) }}"><a
                                href="{!! route('profile') !!}"><i class="fa fa-circle-o"></i> Profil</a>
                    </li>
                    @endif
                    @if(check_user_access('sub-accounts'))
                    <li class="{{ set_active(['admin/store','admin/store/*']) }}"><a
                                href=""><i class="fa fa-circle-o"></i> Sub-accounts</a>
                    </li>
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
            @if(check_user_access(['research_tools', 'data_collections', 'research_tools_partner', 'data_collections_partner', 'keyword_number']))
            <li class="treeview {{ set_active(['admin/research-tools/*', 'admin/research-tools', '/admin/data-collections', '/admin/data-collections/*',
                                                'partner/research-tools/*', 'partner/research-tools', 'partner/data-collections', 'partner/data-collections/*']) }}">
                    <a href="#">
                        <i class="fa fa-pencil"></i>
                        <span>Keywords trends</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(check_user_access(['research_tools', 'research_tools_partner']))
                            <li class="{{ set_active(['admin/research-tools','admin/research-tools/*','partner/research-tools','partner/research-tools/*' ]) }}"><a
                                        href="{!! ($user->type == 1) ? route('research_tools') : route('research_tools_partner') !!}"><i class="fa fa-circle-o"></i> Research tools</a>
                            </li>
                        @endif
                        @if(check_user_access('data_collections', 'data_collections_partner', 'keyword_number'))
                            <li class="{{ set_active(['admin/data-collections','admin/data-collections/*','partner/data-collections','partner/data-collections/*' ]) }}"><a
                                    href="{!! ($user->type == 1) ? route('data_collections') : route('data_collections_partner') !!}"><i class="fa fa-circle-o"></i> Data collections</a></li>
                        @endif
                    </ul>
            </li>
            @endif

             <?php
                $html = '';
                $active_url = [];
                foreach(get_training_pages() as $page) {  
                    $html = $html.'<li class="'.set_active([$page->url->target_url]).'">';
                    $html = $html.'<a href="'.url($page->url->target_url) .'">';
                    $html = $html.'<i class="fa fa-circle-o"></i>'.$page->english->page_title.'</a></li>';
                    $active_url[] = $page->url->target_url;
                }
            ?>
            <li class="treeview {{ set_active($active_url)}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Training</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php echo $html; ?>
                </ul>
            </li>
            
    
            @if(check_user_access(['help-faq', 'help-faq-partner', 'tickets-subscribe', 'tickets-subscribe-partner']))
            <li class="treeview {{ set_active(['admin/tickets-subscribe','partner/tickets-subscribe', 'admin/help-faq', 'partner/help-faq']) }}">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Support + FAQ </span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access(['help-faq','help-faq-partner']))
                    <li class="{{ set_active(['admin/help-faq','partner/help-faq']) }}">
                        <a href="{!! ($user->type == 1) ? route('help-faq') : route('help-faq-partner') !!}">
                            <i class="fa fa-circle-o"></i> FAQ
                        </a>
                    </li>
                    @endif
                    @if(check_user_access(['tickets-subscribe','tickets-subscribe-partner']))
                    <li class="{{ set_active(['admin/tickets-subscribe','partner/tickets-subscribe']) }}">
                        <a href="{!! ($user->type == 1) ? route('tickets-subscribe') : route('tickets-subscribe-partner') !!}">
                            <i class="fa fa-circle-o"></i> Support
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            
                <!-- Admin -->
            @if(check_user_access(['profile_partner','sub-accounts']))
            <li class="treeview {{ set_active(['admin/profile','partner/profile']) }}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Accounts</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(check_user_access(['profile','profile_partner']))
                    <li class="{{ set_active(['admin/profile','partner/profile']) }}">
                        <a href="{!! ($user->type == 1) ? route('profile') : route('profile_partner') !!}"><i class="fa fa-circle-o"></i> Profil</a>
                    </li>
                    @endif
                    @if(check_user_access('sub-accounts'))
                    <li class="">
                        <a href="#"><i class="fa fa-circle-o"></i> Sub-accounts</a>
                    </li>
                    @endif
                   
                </ul>
            </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>