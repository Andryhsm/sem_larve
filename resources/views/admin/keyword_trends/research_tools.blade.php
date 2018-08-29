@extends($layout)

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box"> 
                    <div class="box-body"> 
                     <div class="research_tools">
                        <div id="regForm">
                          <!-- One "tab" for each step in the form: -->
                          <div class="tab_form">
                            <div class="notification">
                            </div>
                            <h3>Keywords import</h3>
                        		<form id="import-data" action="{{ route('import_excel_partner') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        			<div class="col-lg-10 import_label">
                        			    <label for="import_file" class="custom_import_file">
                                            <i class="fa fa-download"></i>
                                            Choose file to import (csv or Excel)
                                        </label>
                                        <a id="import_help">
                                            <i class="fa fa-question-circle"></i>
                                        </a>
                                        <input type="file" id="import_file" name="import_file" class="hiddeninputfile" autocomplete="off"/>
                        			    <p class="file_name"></p>
                        			   <div class="import_help">
                        			        <p>Import an Excel or CSV file with one column. </p> 
                                            <p>First Row/description will not be imported. </p>
                        			    </div>
                        			</div>
                        			<div class="col-lg-2">
                        			    <button class="btn btn-primary import_files" type="submit" style="margin-top:2.5%;">Import File</button>
                        			</div>
                        		</form>
                          </div>
                          <div class="tab_form">
                            <h3>Imported data</h3>
                            <div class="col-lg-12">
                                <div class="keyword_list">
                                    <div class="col-lg-8 number">
                                        Keywords imported  
                                    </div>
                                    <div class="col-lg-4 row keyword-button">
                                        <button class="btn btn-primary pull-right" id="show_keyword_list" disabled>Show keywords list</button>
                                        <button class="btn btn-danger pull-right hidden" id="delete_keyword_in_list">Delete</button>
                                    </div>
                                    <div class="col-lg-12">
                                        <p><input placeholder="File path" class="hidden" oninput="this.className = ''" name="file_path"></p>
                                        <table class="table keywords-list table-bordered table-hover table-responsive">
                                          <thead>
                                              <tr>
                                                  <th class="no-sort" style="width: 8%;"><input class="ckeck_all_keyword" type="checkbox" /></th>
                                                  <th>keyword</th>
                                                  <th style="width: 5%;">Edit</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="duplicate_keyword">
                                    <div class="col-lg-8 number">
                                        Duplicate found

                                    </div>
                                    <div class="col-lg-4 row">
                                        <button class="btn btn-primary pull-right" id="show_duplicate_keyword_list" disabled>Show keywords list</button>
                                    </div>
                                </div>
                                 <div class="col-lg-12">
                                    <table style="background: #f4f4f4; margin-top: 5%;" class="table keywords-duplicate-list table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>keyword</th>
                                            <th>Occurence</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table>
                                </div>
                                
                            </div>
                           
                          </div>
                          <div class="tab_form">
                            <!--<div class="notification">-->
                            <!--</div> -->
                            <h3>Data collection parameters</h3>
                            {!! Form::open(array('url' => '','id' =>'keyword_trend_form','class'=>'validate_form')) !!}
                              <div class="col-lg-6">
                                  <div class="form-group flex_bottle">
                                    {!! Form::label('campaign_name', ' Campagne name ', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-8">
                                      {!! Form::text('campaign_name', null, ['class' => 'form-control required','id'=>'campaign_name','placeholder'=>" Campagne name "]) !!}
                                    </div>
                                  </div>
                                  
                                  <div class="form-group flex_bottle">
                                      <label class="col-sm-4 control-label">Country</label>
                                      <div class="col-sm-8">
                                          <select name="country" data-type="country" data-url="{!! route('get_states_partner') !!}" class="form-control required select-location">
                                            @foreach($countries as $country)
                                              <option value="{!! $country->criteria_id !!}">{!! $country->location_name !!}</option>
                                            @endforeach
                                             <option selected="" disabled="">Select a value</option>
                                          </select>
                                      </div>  
                                  </div>
    
                                  <div class="form-group flex_bottle content-select-province">
                                      <label class="col-sm-4 control-label title-province">Area</label>
                                      <div class="col-sm-8">
                                          <select name="location" data-type="province" data-url="{!! route('get_states_partner') !!}" class="form-control required select-location select-province">
                                            <option disabled="" selected="">Select a value</option>
                                          </select>
                                      </div>  
                                  </div>

                                  <div class="form-group flex_bottle content-select-state">
                                      
                                  </div>
                                  
                                  <div class="form-group flex_bottle">
                                     <label class="col-sm-4 control-label">Language</label>
                                      <div class="col-sm-8">
                                            <select name="language_code" class="form-control required">
                                               <option value="1019" selected="">Arabic</option>
                                               <option value="1056" selected="">Bengali</option>
                                               <option value="1020" selected="">Bulgarian</option>
                                               <option value="1038" selected="">Catalan</option>
                                               <option value="1017" selected="">Chinese (simplified)</option>
                                               <option value="1018" selected="">Chinese (traditional)</option>
                                               <option value="1039" selected="">Croatian</option>
                                               <option value="1021" selected="">Czech</option>
                                               <option value="1009" selected="">Danish</option>
                                               <option value="1010" selected="">Dutch</option>
                                               <option value="1000" selected="">English</option>
                                               <option value="1043" selected="">Estonian</option>
                                               <option value="1042" selected="">Filipino</option>
                                               <option value="1011" selected="">Finnish</option>
                                               <option value="1002" selected="">French</option>
                                               <option value="1001" selected="">German</option>
                                               <option value="1022" selected="">Greek</option>
                                               <option value="1027" selected="">Hebrew</option>
                                               <option value="1023" selected="">Hindi</option>
                                               <option value="1024" selected="">Hungarian</option>
                                               <option value="1026" selected="">Icelandic</option>
                                               <option value="1025" selected="">Indonesian</option>
                                               <option value="1004" selected="">Italian</option>
                                               <option value="1005" selected="">Japanese</option>
                                               <option value="1012" selected="">Korean</option>
                                               <option value="1028" selected="">Latvian</option>
                                               <option value="1029" selected="">Lithuanian</option>
                                               <option value="1102" selected="">Malay</option>
                                               <option value="1013" selected="">Norwegian</option>
                                               <option value="1064" selected="">Persian</option>
                                               <option value="1030" selected="">Polish</option>
                                               <option value="1014" selected="">Portuguese</option>
                                               <option value="1032" selected="">Romanian</option>
                                               <option value="1031" selected="">Russian</option>
                                               <option value="1035" selected="">Serbian</option>
                                               <option value="1033" selected="">Slovak</option>
                                               <option value="1034" selected="">Slovenian</option>
                                               <option value="1003" selected="">Spanish</option>
                                               <option value="1015" selected="">Swedish</option>
                                               <option value="1130" selected="">Tamil</option>
                                               <option value="1131" selected="">Telugu</option>
                                               <option value="1044" selected="">Thai</option>
                                               <option value="1037" selected="">Turkish</option>
                                               <option value="1036" selected="">Ukrainian</option>
                                               <option value="1041" selected="">Urdu</option>
                                               <option value="1040" selected="">Vietnamese</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group flex_bottle">
                                      {!! Form::label('monthly_searches', 'Include monthly research', ['class' => 'col-sm-6 control-label']) !!}
                                      <div class="col-sm-6">
                                          {!! Form::checkbox('monthly_searches', null, false) !!}
                                      </div>
                                  </div>
                                  <div class="form-group flex_bottle">
                                      {!! Form::label('monthly_searches', 'Include search partner', ['class' => 'col-sm-6 control-label']) !!}
                                      <div class="col-sm-6">
                                          {!! Form::checkbox('monthly_searches', null, false) !!}
                                      </div>
                                  </div>
                                  <div class="form-group flex_bottle">
                                      {!! Form::label('convert_null_to_zero', 'Convert NULL values to Zero', ['class' => 'col-sm-6 control-label']) !!}
                                      <div class="col-sm-6">
                                          {!! Form::checkbox('convert_null_to_zero', null, false) !!}
                                      </div>
                                  </div> 
                              </div>
                              <div class="col-lg-12">
                                  <a class=" btn btn-primary pull-right" id="btn_data_collection" disabled>Launch data collection</a>
                              </div>
                            {!! Form::close() !!}
                          </div>
                           <div class="tab_form hidden">
                               <h3>Processing</h3>
                               <div class="col-lg-12">    
                                  <div class="notifying flex_bottle">
                                  	 <p class="progress_stat"></p>
                                  	 <div class="progressbar">
                                  	    <div class="bar"></div>
                                  	 </div>                                  	 
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                   <span class="data_collect_notification pull-left"></span>
                                   <a class="link_result btn btn-primary pull-right" href="{{ route('overview-list') }}">See the result</a>
                               </div>
                           </div>
                          
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
         
    </section> 
@endsection
@section('additional-scripts')
   {!! Html::script('backend/js/keyword_trends.js') !!}
@stop 