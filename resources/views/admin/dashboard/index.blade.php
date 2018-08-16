@extends($layout)

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>

    <section class="content">
        <section class="content">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Title 1</span>
                            <span class="info-box-number">00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa ion-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Title 2</span>
                            <span class="info-box-number">00</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Title 3</span>
                            <span class="info-box-number">00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Title 4</span>
                            <span class="info-box-number">00</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Bloc 1</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <!-- <ul class="users-list clearfix">
                                        
                                        <li>
                                            <a class="users-list-name" href="javascript:void(0)">Name</a>
                                            <span class="users-list-date">Date</span>
                                        </li>
                                        
                                    </ul> -->
                                </div>
                                <div class="box-footer text-center">
                                    <a href="#" class="uppercase">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Bloc 2</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <!-- <ul class="products-list product-list-in-box">
                                        
                                        <li class="item">
                                            <div class="product-img">
                                                Image
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">Name
                                                    <span class="label label-warning pull-right">00</span></a>
                                                <span class="product-description">
                                                    decription
                                                </span>
                                            </div>
                                        </li>
                                    </ul> -->
                                </div>
                                <div class="box-footer text-center">
                                    <a href="#" class="uppercase">View All</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bloc 3</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <!-- <ul class="products-list product-list-in-box">
                                
                                <li class="item">
                                    <div class="product-img">
                                        Image
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">Name
                                            <span class="product-description">
                                              Desc
                                            </span>
                                    </div>
                                </li>
                                
                            </ul> -->
                        </div>
                        <div class="box-footer text-center">
                            <a href="#" class="uppercase">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bloc 4</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <!-- <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">date</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                    <div class="box-footer clearfix">
                        <a href="#" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop
