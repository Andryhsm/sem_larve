<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Support\Facades\Input;

class KeywordTrendsController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function researchTools()
    {
        return view('admin.keyword_trends.research_tools');
    }
    
    public function dataCollections()
    {
        return view('admin.keyword_trends.data_collections');
    }
    
    public function importExcel()
	{
		$keyword = "";
		if(Input::hasFile('import_file')){
			    $path = Input::file('import_file')->getRealPath();
			    $original_name = Input::file('import_file')->getClientOriginalName();
			    $ext = pathinfo($original_name, PATHINFO_EXTENSION);
			    if($ext != 'csv' && $ext != 'xlsx')
			        return response()->json([
			            	'status' => 'error_ext',
			            	'message' => 'You have uploaded the wrong extension! Only the extension .csv and .xlsx are accepted! Try again please!',
			            	'type_alert' => 'alert-danger'
			            ]);
			    $data = Excel::load($path, function($reader) {})->get();
			if(!empty($data) && $data->count()){
			    $keyword = $data[0]->keys()[0];
			    
				foreach ($data as $key => $value) {
					if($value->$keyword != false)
						$insert[] = $value->$keyword;
				}
				
			} else {
		        return response()->json([
        		    'status' => 'empty', 
        		    'message' => "The data is empty"
        		]);	    
			}
		} else {
		    return response()->json([
		         'status' => 'no_file',
		         'message' => "You must select the file to import!",
		         'type_alert' => 'alert-danger'
		        ]);
		}
		if($keyword == "") {
			return response()->json([
		    	'status' => 'not_finish', 
		    	'message' => "Some keywords can not be recovered. Please create a csv file and manually copy the contents of this file to it and try again if you want to have a correct keywords list!",
		    	'data' => $insert,
		    	'type_alert' => 'alert-warning'
		    ]);	
		}
			   
		return response()->json([
		    'status' => 'ok', 
		    'message' => "Your file is successfully uploaded!",
		    'data' => $insert,
		    'type_alert' => 'alert-success'
		    ]);
	}
	
	public function makeRequestAdwords(Request $request) {
		$keywrods = Input::get('keywords');
		dd($keywrods);
	}

}
