@extends($layout)
@section('additional-styles')
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
    * {
      box-sizing: border-box;
    }
    
    body {
      background-color: #f1f1f1;
    }
    
    #regForm {
      background-color: #ffffff;
      margin: 100px auto;
      padding: 5px;
      width: 100%;
      min-width: 300px;
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
    .column1 {
      float: left;
      border-right: 4px solid #514949;
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
    #keyword_trend_form {
      width: 90%;
      margin: auto;
    }
    #keyword_trend_form input[type="checkbox"] {
      width: auto !important;
    }
    .bottle {
      content: '';
      clear: both;
      display: flex;
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
                        <div id="regForm">
                          <!-- One "tab" for each step in the form: -->
                          <div class="tabtab hidden">
                            <h1>Connect your google Adwords account</h1>
                            <p><input type="email" placeholder="e-mail" oninput="this.className = ''" name="ads-e-mail"></p>
                            <p><input type="password" placeholder="password" oninput="this.className = ''" name="ads-password"></p>
                          </div>
                          <div class="tab">
                            <div class="notification">
                            </div>
                            <h1>File importation</h1>
                            <br><br>
                             <label for="file" class="custom_import_file">
                                <i class="fa fa-download"></i>
                                Choose file to import (csv or Excel)
                            </label>
                            <!-- input type="file" name="file" id="file" class="hiddeninputfile" />
                            <label for="file" class="custom_import_file">
                                <i class="fa fa-download"></i>
                                Chooses file to import (csv or Excel)
                            </label -->
                            <br><br><br>
                              <!-- start form -->
                            	<div class="container">
                            		<form id="import-data" style="width: 60%; height: 150px;" action="{{ route('import_excel_partner') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            			<input type="file" name="import_file" autocomplete="off"/>
                            			<button class="file_name hidden" data-toggle="popover" title="File name" data-content="e"></button>
                            		  <button class="btn btn-primary" type="submit" class="import_files" style="margin-top:2.5%;">Import File</button>
                            		</form>
                            	</div>
                              <!-- end form -->
                          </div>
                          <div class="tab">
                            <h1>List Keywords</h1>
                            <div class="col-lg-12 text-center keyword-button" style="margin: 3% 0;">
                              <button class="btn btn-primary" id="show_keyword_list">Show keywords list</button>
                              <button class="btn btn-danger hidden" id="delete_keyword_in_list">Delete</button>
                            </div>
                            <p><input placeholder="File path" class="hidden" oninput="this.className = ''" name="file_path"></p>
                              
                                <table class="table keywords-list table-bordered table-hover table-responsive hidden">
                                  <thead>
                                      <tr>
                                          <th class="no-sort"><input class="ckeck_all_keyword" type="checkbox" /></th>
                                          <th>keyword</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              
                              <div class="row">
                                <div class="col-lg-12 text-center">  
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
                          <div class="tab"> 
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
                                                                                       <option value="1000029" selected="">Chacabuco</option>
                                                                                       <option value="1000030" selected="">Colon</option>
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
                           <div class="tab">
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
                           </div>
                          <div>
                            <div style="float:right;">
                              <button type="button" class="btn btn-default" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                              <button type="button" class="btn btn-primary next-button disabled" onclick="nextPrev(1)">Next</button>
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
   {!! Html::script('backend/js/keyword_trends.js') !!}
@stop 