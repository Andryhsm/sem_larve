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
    .notifying {
  		width: 284px;
	    padding: 10px 10px 20px 10px;
	    border: 1px solid #BFBFBF;
	    border-radius: 4px;
	    background-color: white;
	    box-shadow: 5px 5px 5px #aaaaaa;
  		position: fixed;
  		z-index: 9;
  		right: 50px;
      top: 100px;
  	}
    .progress-label {
	    float: left;
	    margin-left: 50%;
	    margin-top: 5px;
	    font-weight: bold;
	    text-shadow: 1px 1px 0 #ddd;
	  }
	  tbody {
        display:block;
        max-height:400px;
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
                                <h1>Campaign list</h1>
                                <table id="campaign_list" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Campaign name</th>
                                        <th class="no-sort">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($campaigns)>0)
                                        @foreach($campaigns as $campaign)
                                        <tr>
                                            <td>{!! $campaign->campaign_name !!}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default btn-sm show_keyword_number" action="{{ route('show_campaign_keywords') }}" data-id="{!! $campaign->campaign_id !!}" title="View"><i
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
                                <!--<div class="notifying">-->
                                <!--  <div id="progressbar">-->
                              	 <!--   <div class="progress-label">Loading...</div>-->
                              	 <!-- </div>-->
                                <!--</div>-->
                                <br><br>
                                <div>
                                    <div>
                                      <button type="button" class="btn btn-default pull-left" id='previous'>Previous</button>
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
