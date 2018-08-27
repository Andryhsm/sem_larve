@extends($layout)
@section('additional-styles')
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}
    <style>
    * {
      box-sizing: border-box;
    }
    
    body {
      background-color: #f1f1f1;
    }

    
    h1 {
      text-align: center;  
    }
    
    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }
    
    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }
    
    /* Hide all steps by default: */
    .tab {
      display: none;
    }
    
    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;  
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }
    
    .step.active {
      opacity: 1;
    }
    
    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #4CAF50;
    }
    .hiddeninputfile {
    	width: 0.1px;
    	height: 0.1px;
    	/*opacity: 0;*/
    	overflow: hidden;
    	position: absolute;
    	z-index: -1;
    }
    .custom_import_file {
        font-size: 1.25em;
        font-weight: 700;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
    }
    
	/*  tbody {
        display:block;
        max-height:100vh !important;
        overflow-y:scroll;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;
    }
    thead {
        width:100%; 
    }
    table {
        width:100%;
    }*/
   
    /*.td_body {
        display: none;
        transition: all 1s ease-in-out;
    }
    .td_body ul {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding: 0;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }*/
    .content-monthly-searches ul li {
        padding: 7px;
        list-style-type: none;
        background-color: lightgrey;
        margin: 2px;
        border-radius: 4px;
        text-align: center;
    }
    a .fa-angle-down, a .fa-angle-up {
        font-size: 20px;
    }
</style>
@stop
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
                            <div class="tab">
                                <h1>Research list</h1>
                                <table id="campaign_list" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Research name</th>
                                        <th>Région</th>
                                        <th>Language</th>
                                        <th>Username</th>
                                        <th>Date</th>
                                        <th class="no-sort">Action</th>   <!--style="width:10%;"-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($campaigns)>0)
                                        @foreach($campaigns as $campaign)
                                        <tr>
                                            <td>{!! $campaign->campaign_name !!}</td>
                                            <td>{!! ($campaign->location) ? $campaign->location->location_name:'' !!}</td>
                                            <td>{!! ($campaign->language) ? $campaign->language->language_name:'' !!}</td>
                                            <td>{!! ($campaign->user) ? ($campaign->user->last_name.' '.$campaign->user->first_name) : '' !!}</td>
                                            <td>{!! $campaign->added_on !!}</td>
                                            <td>  
                                                <div class="btn-group">
                                                    <a class="btn btn-default btn-sm show_keyword_number" action="{{ route('show_campaign_keywords') }}" data-id="{!! $campaign->campaign_id !!}" title="View" style="margin-right:6px;"><i
                                                                class="fa fa-fw fa-eye"></i></a> 
                                                                
                                                    <a class="btn btn-default btn-sm delete-campaign" action="{{ route('delete_campaign') }}" data-id="{!! $campaign->campaign_id !!}" title="View">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
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
                            <div class="tab">
                            
                                <h1>Keywords</h1>
                                @include('admin.keyword_trends.keyword_number')
                                <br><br>
                                
                                <br><br>
                                <div>
                                    <div>
                                      <button type="button" class="btn btn-default pull-left" id='previous'>Previous</button>
                                      <button type="button" onclick="exportTo('xls');" class="btn btn-primary pull-right" >Exporter</button>
                                    </div>
                                </div>
                            </div>
                         
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Start modal -->
        <div class="modal fade" id="showColumnModal" tabindex="-1" role="dialog" aria-labelledby="showColumnLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="showColumnLabel">Select column to show</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="checkbox">
                    <label><input class="col1" onclick="show_column(this);" type="checkbox" checked="" value="0">Research name</input></label>
                </div>
                <div class="checkbox">  
                    <label><input class="col2" onclick="show_column(this);" type="checkbox" checked="" value="1">Region</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col3" onclick="show_column(this);" type="checkbox" checked="" value="2">Language</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col4" onclick="show_column(this);" type="checkbox" checked="" value="3">Username</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col5" onclick="show_column(this);" type="checkbox" checked="" value="4">Date</input></label>
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
    {!! Html::script('backend/js/data_collection.js') !!}
@stop

@section('footer-scripts')
<script>
    if (jQuery('#campaign_list').length > 0) {
        jQuery('#campaign_list').DataTable({
            "responsive": true,
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "bAutoWidth": false,
            "order": [[5, "desc"]],
            "lengthMenu": [20, 40, 60, 80, 100],
            "pageLength": 20,
            columns: [
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: false},
                {searchable: false, sortable: false}
            ],
            fnDrawCallback: function () {
                var $paginate = this.siblings('.dataTables_paginate');
                if (this.api().data().length <= this.fnSettings()._iDisplayLength) {
                    $paginate.hide();
                }
                else {
                    $paginate.show();
                }
            }
        });
        
        $('#campaign_list_length').append('<div class="btn btn-samall">'+
            '<div class="btn-group" data-toggle="modal" data-target="#showColumnModal">'+
              '<a href="#" class="btn btn-default">Select column to show</a>'+
              '<a href="#" class="btn btn-default"><span class="caret"></span></a>'+
            '</div>'+
        '</div>');
        
    }

    if (jQuery('.dataTables_filter').length > 0) {
        jQuery('.dataTables_filter').find('input').addClass('form-control')
    }
    
    var table = $('#campaign_list').DataTable();
    
    function show_column(box){
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
