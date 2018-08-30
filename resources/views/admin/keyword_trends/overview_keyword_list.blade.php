@extends($layout)

@section('content')
<!--<section class="content-header">
    <h1>
        Research tools Page
    </h1>
</section>-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box"> 
                <div class="box-body"> 
                    <div class="">
                      <!-- One "tab" for each step in the form: -->
                        <div class="tab" >
                        
                            <h1>Keywords</h1>
                                <?php $months = [ "january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december" ]; ?>
                                <table class="table table-bordered table-hover" id="keyword_number_overview"> 
                                     <thead>
                                        <tr>
                                            <th>Keyword</th>
                                            <th>Curency</th>
                                            <th>Avg. monthly searches</th>
                                            <th>Competition</th>
                                            <th>Top of page bid (low range)</th>
                                            <th>Top of page bid (high range)</th>
                                            <th>Ad impression share</th>
                                            <th>Organic impression share</th>
                                            <th>Organic average position</th>
                                            <th>In account?</th>
                                            <th>In plan?</th>
                                            <?php
                                            if(count($datas)>0 && $datas[0]->target_monthly_search) != '') {
                                                foreach(explode('||', $datas[0]->target_monthly_search) as $head){
                                                    if(isset($head)){
                                                        $dates = explode(';', $head);
                                                        echo '<th>Searches: ' . $months[$head[1] -1] .' ' . $head[0] . '</th>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($datas)>0)
                                            @foreach($datas as $keyword)
                                            <tr>
                                                <td>{!! $keyword->keyword_name !!}</td>
                                                <td>{!! $keyword->currency !!}</td>
                                                <td>{!! $keyword->avg_monthly_searches !!}</td>
                                                <td>{!! $keyword->competition !!}</td>
                                                <td>{!! $keyword->low_range_top_of_page_bid !!}</td>
                                                <td>{!! $keyword->high_range_top_of_page_bid !!}</td>
                                                <td>{!! $keyword->ad_impression_share !!}</td>
                                                <td>{!! $keyword->organic_impression_share !!}</td>
                                                <td>{!! $keyword->organic_average_position !!}</td>
                                                <td>{!! $keyword->in_account !!}</td>
                                                <td>{!! $keyword->in_plan !!}</td>
                                                <?php       
                                                if($keyword->target_monthly_search != '') {
                                                    $tab_result_months = explode('||', $keyword->target_monthly_search);
                                                    foreach ($tab_result_months as $result_month) {
                                                        $text_month = explode(';', $result_month);
                                                        
                                                        if(isset($text_month[2])) {
                                                            echo '<td>'.$text_month[2].'</td>';
                                                        }
                                                    }
                                                }
                                                ?>            
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                              <td colspan='11'>No record found</td>
                                            </tr>
                                            @endif
                                                        
                                                
                                        </tbody>
                                </table>
        
                                <br><br>
                                    
                                <br><br>
                                <div>
                                    <div>
                                      <a type="button" class="btn btn-default pull-left" href="{!! route('data_collections_partner') !!}">Go to Data collections list</a>
                                      <button type="button" onclick="exportTo('xls');" class="btn btn-primary pull-right" >Exporter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start modal for search data -->
    <div class="modal fade" id="showKeywordColumnModalOverview" tabindex="-1" role="dialog" aria-labelledby="showKeywordColumnLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showKeywordColumnLabel">Select column to show</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">  
            <!-- Modal content populated from js -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--end modal--> 
</section> 
@endsection
@section('additional-scripts')
    
    {!! Html::script('backend/js/TableExport/tableExport.js') !!}
    {!! Html::script('backend/js/data_collection.js') !!}
@stop
