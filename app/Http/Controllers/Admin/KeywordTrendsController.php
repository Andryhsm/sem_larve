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
		if(Input::hasFile('import_file')){
			    $path = Input::file('import_file')->getRealPath();
			    $data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
				    \Log::debug($value);
					$insert[] = ['title' => $value->title, 'description' => $value->description];
				}
				
			} else {
		        return response()->json([
        		    'status' => 'empty', 
        		    'message' => "The data is empty"
        		]);	    
			}
		}
		return response()->json([
		    'status' => 'ok', 
		    'message' => "Import data with success",
		    'data' => $insert
		    ]);
	}

    
}
