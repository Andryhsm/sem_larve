@extends($layout)
@section('additional-styles')
    <!-- <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}

    <!-- {!! Html::Style('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css') !!} -->
    {!! Html::Style('https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css') !!}
@stop
@section('content')
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
                                            <td>{!! ($campaign->area) ? $campaign->area->location_name:'' !!}</td>
                                            <td>{!! ($campaign->language) ? $campaign->language->language_name:'' !!}</td>
                                            <td>{!! ($campaign->user) ? ($campaign->user->last_name.' '.$campaign->user->first_name) : '' !!}</td>
                                            <td>{!! $campaign->added_on !!}</td>
                                            <td>  
                                                <div class="btn-group">
                                                    <a class="btn btn-default btn-sm show_keyword_number" href="{{ route('overview-list') }}" data-id="{!! $campaign->campaign_id !!}" title="View" style="margin-right:6px;"><i
                                                                class="fa fa-fw fa-eye"></i></a> 
                                                                
                                                    <a class="btn btn-default btn-sm delete-campaign" action="{{ route('delete_campaign') }}" data-id="{!! $campaign->campaign_id !!}" title="View">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </a>
<<<<<<< HEAD
                                                    <a class="btn btn-default btn-sm tracksave-campaign" href="{{ route('tracksave_campaign',$campaign->campaign_id) }}" data-id="{!! $campaign->campaign_id !!}" data-area_id="{!!  $campaign->area_id !!}" data-monthly_searches="{!!  $campaign->monthly_searches !!}" data-convert_null_to_zero="{!!  $campaign->convert_null_to_zero !!}" data-language_id="{!!  $campaign->language_id !!}" title="View" style="margin-left:6px;">
=======
                                                    <a class="btn btn-default btn-sm delete-campaign" action="{{ route('delete_campaign') }}" data-id="{!! $campaign->campaign_id !!}" data-area_id="{!!  $campaign->area_id !!}" data-monthly_searches="{!!  $campaign->monthly_searches !!}" data-convert_null_to_zero="{!!  $campaign->convert_null_to_zero !!}" data-language_id="{!!  $campaign->language_id !!}" title="View" style="margin-left:6px;">
>>>>>>> f50bfa864b0a0045295f3aa1956cd52681f69b99
                                                        <span> Track & Save</span>
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
                            
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Start modal for search data -->
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
                    <label><input class="col1" onclick="show_column(this);" table-id="#campaign_list" type="checkbox" checked="" value="0">Research name</input></label>
                </div>
                <div class="checkbox">  
                    <label><input class="col2" onclick="show_column(this);" table-id="#campaign_list" type="checkbox" checked="" value="1">Region</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col3" onclick="show_column(this);" table-id="#campaign_list" type="checkbox" checked="" value="2">Language</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col4" onclick="show_column(this);" table-id="#campaign_list" type="checkbox" checked="" value="3">Username</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col5" onclick="show_column(this);" table-id="#campaign_list" type="checkbox" checked="" value="4">Date</input></label>
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
                {searchable: true, sortable: true},
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
        
        $('#campaign_list_length').append('<div class="btn btn-small">'+
            '<div class="btn-group" data-toggle="modal" data-target="#showColumnModal">'+
              '<a href="#" class="btn btn-default">Select column to show</a>'+
              '<a href="#" class="btn btn-default"><span class="caret"></span></a>'+
            '</div>'+
        '</div>');
        
        $('.show_keyword_number').each(function(key, element) {
            var link = $(element).attr('href');
            var id = $(element).attr('data-id');
            var full_link = link +'?campaign_id='+id;
            $(element).attr('href', full_link);
        });
    }

    
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


    
    if (jQuery('.dataTables_filter').length > 0) {
        jQuery('.dataTables_filter').find('input').addClass('form-control')
    }    
</script>
@stop
