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
                            			<input type="file" name="import_file" />
                            		  <button class="btn btn-primary" type="submit" class="import_files" style="margin-top:2.5%;">Import File</button>
                            		</form>
                            	</div>
                              <!-- end form -->
                          </div>
                          <div class="tab">
                            <h1>List Keywords</h1>
                            <div class="col-lg-12 text-center keyword-button" style="margin: 3% 0;">
                              <button class="btn btn-primary" id="show_keyword_list">Show keywords list</button>
                            </div>
                            <p><input placeholder="File path" class="hidden" oninput="this.className = ''" name="file_path"></p>
                              <table class="table keywords-list table-bordered table-hover table-responsive hidden">
                                  <thead>
                                      <tr>
                                          <th>keyword</th>
                                          <th class="no-sort">Action</th>
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
                          <div class="tabs hidden">
                            <h1>Parametters</h1>
                            <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
                            <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
                          </div>
                          <div style="overflow:auto;">
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