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
                                <h3>Your Keywords Lists</h3>
                                <div class="col-lg-12">
                                    <div class="duplicate_keyword">
                                        <div class="col-lg-12 row">
                                            <button class="btn btn-primary pull-right" id="show_duplicate_keyword_list">Show keywords list</button>
                                        </div>
                                    </div>
                                     <div class="col-lg-12">
                                        <table style="background: #f4f4f4; margin-top: 5%; " class="table keywords-duplicate-list table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>keyword Name</th>
                                                <th>CPC</th>
                                                <th>Monthly Searches</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                                @foreach ($keywords_decode as $keyword)
                                                    <tr>
                                                        <td>{!! $keyword->keyword_name !!}</td>
                                                        <td>{!! $keyword->cpc !!}</td>
                                                        <td>{!! $keyword->avg_monthly_searches!!}</td>
                                                    </tr>
                                                @endforeach
                                          </tbody>
                                      </table>
                                    </div>
                                    
                                </div>
                               
                              </div>
                          <div class="tab_form">
                            <div class="notification">
                            </div>
                            <h3>Description</h3>
                          </div>
                          <div class="tab_form">
                            <!--<div class="notification">-->
                            <!--</div> -->
                            {{-- <h3> Data collection parameters </h3> --}}
                            {!! Form::open(array('url' =>'','id' =>'keyword_trend_form','class'=>'validate_form')) !!}
                              <div class="col-lg-6">
                                  <div class="form-group flex_bottle">
                                    {!! Form::label('campaign_name', ' Research name ', ['class' => 'col-sm-4 control-label']) !!}:

                                    <div class="col-sm-8">
                                      <span> {!! $campaign->campaign_name !!}</span>
                                      {!! Form::text('campaign_name', $campaign->campaign_name , ['class' => 'form-control required hidden','id'=>'campaign_name','placeholder'=>" Research name "]) !!}
                                    </div>
                                  </div>
                                  {{--  {!! @if($campaign->country_id  == $countrie->criteria_id)?"selected" : "" @endif!!}  --}}
                                  <input type="hidden" value="{!! $campaign->campaign_id !!}" name="campaign_id">
                                  <div class="form-group flex_bottle">
                                      <label class="col-sm-4 control-label"> Country </label>:  
                                      <div class="col-sm-8">
                                          <span>{!! $country !!}</span>
                                          <select name="country" data-type="country" data-url="{!! route('get_states_partner') !!}" class="hidden form-control required select-location">
                                            @foreach($countries as $countrie)
                                              <option value="{!! $countrie->criteria_id !!}" > {!! $countrie->location_name !!}</option>
                                            @endforeach
                                             <option selected="" value = "{!! $campaign->country_id !!}"> {{ $country }}</option>
                                          </select>
                                      </div>  
                                  </div>
    
                                  <div class="form-group flex_bottle content-select-province">
                                      <label class="col-sm-4 control-label">State/province</label>:
                                      <div class="col-sm-8">
                                          <span>{!! $state !!}</span>
                                          <select name="province" data-type="province" data-url="{!! route('get_states_partner') !!}" class="hidden form-control required select-location select-province">
                                            <option selected="" value = "{!! $campaign->province_id !!}">{!!  $state   !!}</option>
                                          </select>
                                      </div>  
                                  </div>

                                  <div class="form-group flex_bottle content-select-state">
                                      <label class="col-sm-4 control-label">Area</label>:
                                      <div class="col-sm-8">
                                         <span>{!! $area !!}</span>
                                          <select name="area" data-type="province" data-url="{!! route('get_states_partner') !!}" class="hidden form-control required select-location select-province">
                                            <option selected="" value = "{!! $campaign->area_id !!}">{!! $area !!}</option>
                                          </select>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group flex_bottle">
                                     <label class="col-sm-4 control-label">Language</label>:
                                      <div class="col-sm-8">
                                            <span>{!! $language !!}</span>
                                            <select name="language_code" class="hidden form-control required">
                                               <option selected="" value = "{!! $campaign->language_id !!}">{!! $language !!}</option>
                                               <option value="1019" >Arabic</option>
                                               <option value="1056" >Bengali</option>
                                               <option value="1020" >Bulgarian</option>
                                               <option value="1038" >Catalan</option>
                                               <option value="1017" >Chinese (simplified)</option>
                                               <option value="1018" >Chinese (traditional)</option>
                                               <option value="1039" >Croatian</option>
                                               <option value="1021" >Czech</option>
                                               <option value="1009" >Danish</option>
                                               <option value="1010" >Dutch</option>
                                               <option value="1000" >English</option>
                                               <option value="1043" >Estonian</option>
                                               <option value="1042" >Filipino</option>
                                               <option value="1011" >Finnish</option>
                                               <option value="1002" selected="">French</option>
                                               <option value="1001" >German</option>
                                               <option value="1022" >Greek</option>
                                               <option value="1027" >Hebrew</option>
                                               <option value="1023" >Hindi</option>
                                               <option value="1024" >Hungarian</option>
                                               <option value="1026" >Icelandic</option>
                                               <option value="1025" >Indonesian</option>
                                               <option value="1004" >Italian</option>
                                               <option value="1005" >Japanese</option>
                                               <option value="1012" >Korean</option>
                                               <option value="1028" >Latvian</option>
                                               <option value="1029" >Lithuanian</option>
                                               <option value="1102" >Malay</option>
                                               <option value="1013" >Norwegian</option>
                                               <option value="1064" >Persian</option>
                                               <option value="1030" >Polish</option>
                                               <option value="1014" >Portuguese</option>
                                               <option value="1032" >Romanian</option>
                                               <option value="1031" >Russian</option>
                                               <option value="1035" >Serbian</option>
                                               <option value="1033" >Slovak</option>
                                               <option value="1034" >Slovenian</option>
                                               <option value="1003" >Spanish</option>
                                               <option value="1015" >Swedish</option>
                                               <option value="1130" >Tamil</option>
                                               <option value="1131" >Telugu</option>
                                               <option value="1044" >Thai</option>
                                               <option value="1037" >Turkish</option>
                                               <option value="1036" >Ukrainian</option>
                                               <option value="1041" >Urdu</option>
                                               <option value="1040" >Vietnamese</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group flex_bottle hidden">
                                      {!! Form::label('monthly_searches', 'Include monthly research', ['class' => 'col-sm-6 control-label']) !!}
                                      <div class="col-sm-6">
                                          {!! Form::checkbox('monthly_searches', null,  $campaign->monthly_searches ) !!}
                                      </div>
                                  </div>
                                 
                                  <div class="form-group flex_bottle">
                                      {!! Form::label('convert_null_to_zero', 'Convert NULL values to Zero', ['class' => 'col-sm-6 control-label']) !!}
                                      <div class="col-sm-6">
                                          {!! Form::checkbox('convert_null_to_zero', null, $campaign->convert_null_to_zero ) !!}
                                      </div>
                                  </div> 
                              </div>
                              <div class="col-lg-12">
                                  <a href="{!!  URL::to('partner/data-collections') !!}" class="btn btn-primary">Return</a>
                                  <a class=" btn btn-primary pull-right" data-url = "{!! route('tracksave_campaign_adwords') !!}" id="btn_data_collection_tracksave">Track & Save</a>
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
                                   <a class="link_result btn btn-primary disabled pull-right" href="{{ route('overview-list') }}">See the result</a>
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
   {!! Html::script('backend/js/loadingoverlay.min.js') !!}
   {!! Html::script('backend/js/keyword_trends.js') !!}
@stop 