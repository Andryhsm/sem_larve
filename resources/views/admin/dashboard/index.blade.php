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
                            <span class="info-box-text">Data Collections</span>
                            <span class="info-box-number">00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa ion-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Processed Keywords</span>
                            <span class="info-box-number">00</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Monthly searches analysed</span>
                            <span class="info-box-number">00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Keywords Tracked</span>
                            <span class="info-box-number">00</span>
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
