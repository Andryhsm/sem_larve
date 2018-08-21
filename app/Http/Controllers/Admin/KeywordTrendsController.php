<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    
}
