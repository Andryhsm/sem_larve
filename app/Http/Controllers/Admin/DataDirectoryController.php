<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataDirectoryController extends Controller
{
	public function __construct() {
		
	}

    public function index() {
    	return view('admin.keyword_trends.data_directory.index');
    }
}
