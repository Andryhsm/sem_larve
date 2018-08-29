@extends($layout)
@section('additional-styles')
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    
	  tbody {
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
    }
    .td_body {
        display: none;
        transition: all 1s ease-in-out;
        margin-left: 50px;
    }
    .td_body_item {
        padding: 7px;
        border: 1;
        border-left: none;
        border-right: none;
    }
    .td_head i {
        font-size: 20px;
    }
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
                            
                                <h1>Keywords</h1>
                                
                                    <table id="keyword_number" class="table table-bordered table-hover">
                                         <thead>
                                                <tr>
                                                    <th>Keyword name</th>
                                                    <th>Search volume</th>
                                                    <th>Cpc</th>
                                                    <th>Competition</th>
                                                    <th style="width:25%;">Target monthly search</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($datas)>0)
                                                    @foreach($datas as $keyword)
                                                    <tr>
                                                        <td>{!! $keyword->keyword_name !!}</td>
                                                        <td>{!! $keyword->search_volume !!}</td>
                                                        <td>{!! $keyword->cpc !!}</td>
                                                        <td>{!! $keyword->competition !!}</td>
                                                        <td style="width:25%;"><?php 
                                                                
                                                                if ($keyword->target_monthly_search != '') {
                                                                    $months = [ "january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december" ];
                                                                    
                                                                    echo '<a class="btn btn-default show-monthly"><i class="fa fa-angle-down"></i></a>';
                                                                    echo '<div class="content-monthly-searches  hidden">';
                                                                            echo '<ul>';
                                                                                $tab_result_months = explode('||', $keyword->target_monthly_search);
                                                                                foreach ($tab_result_months as $result_month) {
                                                                                    $text_month = explode(';', $result_month);
                                                                                    
                                                                                    if(isset($text_month[2])) {
                                                                                        echo '<li>'.$text_month[0].' - '.$months[$text_month[1] - 1].' : '.$text_month[2].'</li>';
                                                                                    }
                                                                                }
                                                                            echo '</ul>';
                                                                    echo '</div>';
                                                                    
                                                                }
                                                                ?></td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                      <td colspan='2'>No record found</td>
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
                         
                          <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center;margin-top:40px;" class="hidden">
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
    </section> 
@endsection
@section('additional-scripts')
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
    <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    
    {!! Html::script('backend/js/TableExport/tableExport.js') !!}
    {!! Html::script('backend/js/data_collection.js') !!}
@stop
