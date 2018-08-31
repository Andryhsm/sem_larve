@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::Style('https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css') !!}
@stop
@section('content')
 <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box"> 
                <div class="box-body"> 
                    <div class="">
                        <div class="tab" > 
                            
                            <!-- <h1> Data collection Parameters </h1> -->
                            <div style="background: #f4f4f4;">    
                                <div style="padding: 15px;">
                                    <div class="row"> 
                                        <div class="col-sm-6 research_name" ><b>Research Name:</b> <span> </span></div>
                                        <div class="col-sm-6 country_name"><b>Country:</b> <span> </span> </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-sm-6 state_name"><b>State/province:</b> <span> </span></div>
                                        <div class="col-sm-6 area_name"><b>Area:</b> <span> </span></div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-sm-6 language"><b>Language:</b> <span> </span></div>
                                        <div class="col-sm-6 mounthly_research"><b>Include monthly research:</b> <span> </span></div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-sm-6 search_partner"><b>Include search partner:</b> <span> </span></div>
                                        <div class="col-sm-6 null_to_zero"><b>Convert NULL values to Zero:</b> <span> </span></div>
                                    </div>
                                </div>                            
                            </div>       
                            <h1>Research list</h1>
                            <input type="text" class="hidden campaign_id" value="{!! $campaign_id !!}">
                            <div >
                               <table id="keyword_number" class="table table-bordered table-hover" data-route = "{{ route('show_campaign_keywords') }}">
                                    <thead>
                                        <tr class="keyword_number_tr">

                                            <th>Keyword</th>
                                            <th>Curency</th>
                                            <th>Avg. monthly searches</th>
                                            <th>Competition</th>
                                            <th>Top of page bid (low range)</th>
                                            <th>Top of page bid (high range)</th>
                                            <th>Ad impression share</th>
                                            <th>Organic impression share</th>
                                            <th>Organic average position</th>
                                            <th>In account</th>
                                            <th>In plan?</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <br><!-- <br>
                            
                            <br><br> -->
                            <div>
                                <div>
                                  <a class="btn btn-default pull-left" id='previous' href="{{ route('data_collections_partner') }}">Previous</a>
                                  <!-- <button type="button" onclick="exportTo();" class="btn btn-primary pull-right" >Exporter</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start modal for search data -->
    <div class="modal fade" id="showKeywordColumnModal" tabindex="-1" role="dialog" aria-labelledby="showKeywordColumnLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showKeywordColumnLabel">Select column to show</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">  
                <div class="checkbox">
                    <label><input class="col1" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" checked="" value="0">Keyword</input></label>
                </div>
                <div class="checkbox">  
                    <label><input class="col2" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" checked="" value="1">Curency</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col3" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" checked="" value="2">Avg. monthly searches</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col4" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" checked="" value="3">Competition</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col5" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" checked="" value="4">Top of page bid (low range)</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col6" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="5">Top of page bid (high range)</input></label>
                </div>
                <div class="checkbox">  
                    <label><input class="col7" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="6">Ad impression share</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col8" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="7">Organic impression share</input></label>
                </div> 
                <div class="checkbox">
                    <label><input class="col9" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="8">Organic average position</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col10" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="9">In account?</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col11" onclick="show_column(this);" table-id="#keyword_number" type="checkbox" value="10">In plan?</input></label>
                </div>
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
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('backend/js/TableExport/tableExport.js') !!}

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    {!! Html::script('backend/js/data_collection.js') !!}

@stop

@section('footer-scripts')
    <script type="text/javascript">
        function show_column(box){
            var id_table = $(box).attr('table-id');
            var table = $(id_table).DataTable();
            col_num = parseInt($(box).attr('value'));
            if($(box).prop('checked'))
            {
                table.column(col_num).visible(true);
            }else{
                table.column(col_num).visible(false);
            }
        }
    </script>
@stop