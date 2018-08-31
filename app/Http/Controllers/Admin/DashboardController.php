<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\KeywordTrendsRepository;

class DashboardController extends Controller
{
	protected $user_repository;

	public function __construct(UserRepositoryInterface $userRepositoy, KeywordTrendsRepository $keyword_trend_repo)
	{
		$this->user_repository = $userRepositoy;
		$this->keyword_trend_repository = $keyword_trend_repo;
	}

	public function index()
    {
    	$admin_id = auth()->guard('admin')->user()->admin_id;
    	$data_collection = $this->keyword_trend_repository->getDataCollectionNumberInMemory($admin_id);
    	
    	return view('admin.dashboard.index', compact(['data_collection', $data_collection]));
    }
}
