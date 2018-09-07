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
    	$data_collection_number = $this->keyword_trend_repository->getDataCollectionNumberInMemory($admin_id);
    	$campaigns = $this->keyword_trend_repository->getAllByUser($admin_id);
    	$keyword_number = 0;
        $keyword_tracked = 0;
    	foreach ($campaigns as $key => $campaign) {
    		$keyword_number += $this->keyword_trend_repository->getKeywordNumberByCampaignId($campaign->campaign_id);
            $keywords = $this->keyword_trend_repository->getKeywordByCampaignId($campaign->campaign_id);
            foreach ($keywords as $keyword) {
                $target_monthly = $keyword->target_monthly_search;
                if($target_monthly != null && $target_monthly != '') {
                    $target_monthly = explode('||', $target_monthly);
                    $last_month = explode(';', $target_monthly[0]);
                    if (\Carbon\Carbon::now()->month <= (int)$last_month[1])
                        $keyword_tracked += 1;
                }
            }
    	}
    	$monthly_searches_analysed = $keyword_number * 24;
    	$last_campaigns = $this->keyword_trend_repository->getLastDataCollection($admin_id);
    	return view('admin.dashboard.index', compact('data_collection_number', 'keyword_number', 'monthly_searches_analysed', 'keyword_tracked', 'last_campaigns'));
    }
}
