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
                            <span class="info-box-number">{{ $data_collection_number }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa ion-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Processed Keywords</span>
                            <span class="info-box-number">{{ $keyword_number }}</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Monthly searches analysed</span>
                            <span class="info-box-number">{{ $monthly_searches_analysed }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Keywords Tracked</span>
                            <span class="info-box-number">{{ $keyword_tracked }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Last data collection</h3>
                        
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="last_data_collection" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Research name</th>
                                <th>Région</th>
                                <th>Language</th>
                                <th>Username</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($last_campaigns)>0)
                                @foreach($last_campaigns as $campaign)
                                <tr>
                                    <td>{!! $campaign->campaign_name !!}</td>
                                    <td>{!! ($campaign->area) ? $campaign->area->location_name:'' !!}</td>
                                    <td>{!! ($campaign->language) ? $campaign->language->language_name:'' !!}</td>
                                    <td>{!! ($campaign->user) ? ($campaign->user->last_name.' '.$campaign->user->first_name) : '' !!}</td>
                                    <td>{!! $campaign->added_on !!}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                  <td colspan='2'>No record found</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="{!! route('data_collections_partner') !!}" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop
