@extends($layout)
@section('additional-styles')
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
    
    #regForm {
      background-color: #ffffff;
      margin-top: 50px;
      padding: 5px;
      width: 100%;
      min-width: 300px;
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
    .tab_form h3 {
        left: 0;
        border-bottom: 1px solid black;
        font-weight: bold;
    }
    .research_tools {
        width: 90%;
        margin: auto;
    }
    .hiddeninputfile {
    	width: 0.1px;
    	height: 0.1px;
    	opacity: 0;
    	overflow: hidden;
    	position: absolute;
    	z-index: -1;
    }
    .title-duplicate {
      margin: 5% 0;
    }
    .custom_import_file {
        font-size: 1.25em;
        font-weight: 700;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
    }
    .custom_import_file i {
        margin-right: 10px;
    }
    .column1 {
      float: left;
      border-right: 4px solid gray;
      padding-right: 50px;
    }
    .column2 {
      float: left;
      margin-left: 50px;
    }
    .column1 p, .column2 p {
      padding-top: 10px;
      padding-bottom: 10px;
    }
    .progress_stat {
        text-align: center;
    }
    #keyword_trend_form {
      width: 100%;
      margin: auto;
    }
    #keyword_trend_form input[type="checkbox"] {
      width: auto !important;
    }
    #import-data {
        width: 60%; 
        height: 250px;
        margin: auto;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
                align-items: center;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
                flex-direction: column;
    }
    .no-duplicate {
        text-align: center;
        padding: 3%;
        font-size: 18px;
    }
    .keywords-duplicate-list thead {
      background: #cecece;
    }
    .bottle {
      content: '';
      clear: both;
      display: flex;
    }
    .file_name {
        display: none;
        background: silver;
        padding: 15px 50px;
        font-size: 18px;
        border-radius: 5px;
        text-align: center;
        transition: all 1s ease-in-out;
    }
    button.import_files {
        display: none;
        transition: all 1s ease-in-out;
    }
    .notifying {
  		width: 300px;
	    padding: 20px 20px;
	    border: 1px solid #BFBFBF;
	    border-radius: 4px;
	    background-color: white;
	    box-shadow: 5px 5px 5px #aaaaaa;
  		position: fixed;
  		z-index: 9;
  		right: 50px;
        top: 100px;
        display: none;
  	}
    .progressbar {
	    float: left;
	    background-color: lightgrey;
	    width: 100%;
	    margin-top: 15px;
	}
	.bar {
	    background-color: gray;
	    color: #fff !important;
	    height: 24px;
	    width: 1%;
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
                             
                            <!-- input type="file" name="file" id="file" class="hiddeninputfile" />
                            <label for="file" class="custom_import_file">
                                <i class="fa fa-download"></i>
                                Chooses file to import (csv or Excel)
                            </label -->
                            
                            	<div class="">
                            		<form id="import-data" action="{{ route('import_excel_partner') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            			<label for="import_file" class="custom_import_file">
                                            <i class="fa fa-download"></i>
                                            Choose file to import (csv or Excel)
                                        </label>
                                        <br><br>
                            			<input type="file" id="import_file" name="import_file" class="hiddeninputfile" autocomplete="off"/>
                            			<p class="file_name"></p>
                            		  <button class="btn btn-primary import_files" type="submit" style="margin-top:2.5%;">Import File</button>
                            		</form>
                            	</div>
                              <!-- end form -->
                          </div>
                          <div class="tab_form">
                            <h1>List Keywords</h1>
                            <div class="col-lg-12 text-center keyword-button" style="margin: 3% 0;">
                              <button class="btn btn-primary" id="show_keyword_list">Show keywords list</button>
                              <button class="btn btn-danger hidden" id="delete_keyword_in_list">Delete</button>
                            </div>
                            <p><input placeholder="File path" class="hidden" oninput="this.className = ''" name="file_path"></p>
                              
                                <table class="table keywords-list table-bordered table-hover table-responsive hidden">
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
                              
                              <div class="row">
                                <div class="col-lg-12 text-center title-duplicate">  
                                  <span>List of duplicate found in the keyword</span>
                                </div>
                              </div>
                              <table style="background: #f4f4f4;" class="table keywords-duplicate-list table-bordered table-hover table-responsive">
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
                          <div class="tab_form">
                            <!--<div class="notification">-->
                            <!--</div> -->
                            <h1>Parametters</h1>
                            {!! Form::open(array('url' => '','id' =>'keyword_trend_form','class'=>'validate_form')) !!}
                              
                              <div class="form-group bottle">
                                {!! Form::label('campaign_name', ' Campagne name ', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                  {!! Form::text('campaign_name', null, ['class' => 'form-control required','id'=>'campaign_name','placeholder'=>" Campagne name "]) !!}
                                </div>
                              </div>
                              
                              <div class="form-group bottle">
                                  <label class="col-sm-3 control-label">Location</label>
                                  <div class="col-sm-9">
                                        <select name="location" class="form-control required">
                                           <option value="1000003" selected="">Luanda</option>
                                           <option value="1000004" selected="">The Valley</option>
                                           <option value="1000010" selected="">Abu Dhabi</option>
                                           <option value="1000011" selected="">Ajman</option>
                                           <option value="1000012" selected="">Al Ain</option>
                                           <option value="1000013" selected="">Dubai</option>
                                           <option value="1000014" selected="">Ras Al-Khaimah</option>
                                           <option value="1000018" selected="">Salta</option>
                                           <option value="1000021" selected="">Avellaneda</option>
                                           <option value="1000024" selected="">Bahia Blanca</option>
                                           <option value="1000025" selected="">Balcarce</option>
                                           <option value="1000027" selected="">Brandsen</option>
                                           <option value="1000028" selected="">Campana</option>
                                           <option value="1002604" selected="">Montreal</option>
                                           <option value="1002605" selected="">Napierville</option>
                                           <option value="1000031" selected="">Del Viso</option>
                                           <option value="1000035" selected="">Isidro Casanova</option>
                                           <option value="1000036" selected="">Junin</option>
                                           <option value="1000037" selected="">La Plata</option>
                                           <option value="1000039" selected="">Lomas de Zamora</option>
                                           <option value="1000040" selected="">Luis Guillon</option>
                                           <option value="1000041" selected="">Lujan</option>
                                           <option value="1000042" selected="">Mar del Plata</option>
                                           <option value="1000044" selected="">Moron</option>
                                           <option value="1000045" selected="">Olavarria</option>
                                           <option value="1000047" selected="">Pergamino</option>
                                           <option value="1000050" selected="">Pinamar</option>
                                           <option value="1000053" selected="">Quilmes</option>
                                           <option value="1000058" selected="">San Antonio de Padua</option>
                                           <option value="1000059" selected="">San Fernando</option>
                                           <option value="1000060" selected="">San Isidro</option>
                                           <option value="1000062" selected="">San Nicolas de los Arroyos</option>
                                           <option value="1000063" selected="">San Pedro</option>
                                           <option value="1000065" selected="">Tandil</option>
                                           <option value="1000066" selected="">Tortuguitas</option>
                                           <option value="1000067" selected="">Trenque Lauquen</option>
                                           <option value="1000069" selected="">Vicente Lopez</option>
                                           <option value="1000070" selected="">Villa Gesell</option>
                                           <option value="1000072" selected="">Zarate</option>
                                           <option value="1000073" selected="">Buenos Aires</option>
                                           <option value="1000075" selected="">Concepcion del Uruguay</option>
                                            <option value="1002612" selected="">Outremont</option>
                                            <option value="1002613" selected="">Papineauville</option>
                                            <option value="1002614" selected="">Piedmont</option>
                                            <option value="1002615" selected="">Pierrefonds-Roxboro</option>
                                            <option value="1002616" selected="">Pohenegamook</option>
                                            <option value="1002617" selected="">Pointe-a-la-Croix</option>
                                            <option value="1002618" selected="">Pointe-aux-Outardes</option>
                                            <option value="1002619" selected="">Pointe-aux-Trembles</option>
                                            <option value="1002620" selected="">Pointe-Claire</option>
                                            <option value="1002621" selected="">Pont-Rouge</option>
                                            <option value="1002622" selected="">Port-Cartier</option>
                                            <option value="1002623" selected="">Portneuf</option>
                                            <option value="1006886" selected="">London</option>
                                            <option value="1006887" selected="">London Colney</option>
                                            <option value="1006888" selected="">Long Eaton</option>
                                            <option value="1006932" selected="">Milnthorpe</option>
                                            <option value="1006933" selected="">Milton Keynes</option>
                                            <option value="1006934" selected="">Mirfield</option>
                                            <option value="1006935" selected="">Mitcheldean</option>
                                            <option value="1006973" selected="">Oswestry</option>
                                            <option value="1006974" selected="">Oundle</option>
                                            <option value="1010224" selected="">Port Louis</option>
                                            <option value="1010225" selected="">Blantyre</option>
                                            <option value="1010227" selected="">Ipoh</option>
                                            <option value="1010228" selected="">Kuala Kangsar</option>
                                      </select>
                                  </div>  
                              </div>
                              
                              <div class="form-group bottle">
                                 <label class="col-sm-3 control-label">Language</label>
                                  <div class="col-sm-9">
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
                              
                              <div class="form-group bottle">
                                  {!! Form::label('monthly_searches', 'Monthly Searches', ['class' => 'col-sm-3 control-label']) !!}
                                  <div class="col-sm-9">
                                      {!! Form::checkbox('monthly_searches', null, false) !!}
                                  </div>
                              </div>
                              
                              <div class="form-group bottle">
                                  {!! Form::label('convert_null_to_zero', 'Convert NULL values to Zero', ['class' => 'col-sm-3 control-label']) !!}
                                  <div class="col-sm-9">
                                      {!! Form::checkbox('convert_null_to_zero', null, false) !!}
                                  </div>
                              </div> 
                              
                            {!! Form::close() !!}
                          </div>
                           <div class="tab_form">
                              <h1>Summary</h1>
                              <div class="summary panel panel-default">
                                  <div class="panel-body">
                                      <!--<div class="panel-heading">Summary</div>-->
                                      <div class="row">
                                          <div class="col-xs-12">
                                            <div class="column1">
                                              <p><strong>Campagne Name:</strong></p>
                                              <p><strong>Language Code:</strong></p>
                                              <p><strong>Monthly searches:</strong></p>
                                              <p><strong>Convert NULL values to Zero:</strong></p>
                                            </div>
                                            <div class="column2">
                                              <p><span class="campaign_name"></span></p>
                                              <p><span class="location"> </span></p>
                                              <p><span class="monthly_searches"></span></p>
                                              <p><span class="convert_null_to_zero"></span></p>
                                            </div>
                                          </div>
                                      </div>
                                </div>
                              </div>
                              <div class="link_result" data-link="{{ route('overview-list') }}">
                                  
                              </div>
                              <div class="notifying">
                              	 <p class="progress_stat"></p>
                              	 <div class="progressbar">
                              	    <div class="bar"></div>
                              	 </div>
                              </div>
                           </div>
                          <div>
                            <div style="float:right;">
                              <button type="button" class="btn btn-default" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                              <button type="button" class="btn btn-primary next-button disabled" onclick="nextPrev(1)">Next</button>
                              <button type="button" disabled class="btn btn-primary hidden" id="btn_data_collection" onclick="nextPrev(1)">Create a new data Collection</button>
                               <button type="button" class="btn btn-primary hidden" id="launch">Launch</button>
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
        </div>
         
    </section> 
@endsection
@section('additional-scripts')
   {!! Html::script('backend/js/keyword_trends.js') !!}
@stop 