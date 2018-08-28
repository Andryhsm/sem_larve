<?php

namespace App\Repositories;


use App\Models\Campaign;
use App\Models\Keyword;
use Carbon\Carbon;

class KeywordTrendsRepository
{
	protected $modelCampaign;
	protected $modelKeyword;

	public function __construct(Campaign $campaign, Keyword $keyword)
	{
		$this->modelCampaign = $campaign;
		$this->modelKeyword = $keyword;
	}

	public function getAllByUser($id)
	{
		return $this->modelCampaign->with('location','language','user')->where('admin_id',$id)->orderBy('campaign_id','desc')->get();
	}

	public function getKeywordByCampaignId($id)
	{
		return $this->modelKeyword->where('campaign_id',$id)->get();	
	}
	
	public function deleteCampaignById($id)
	{
		return $this->modelCampaign->destroy($id);
	}

	public function storeDataCollection($input) 
	{
		$keyword_results = $input['keywords_result'];
		$params = $input['params'];
		
		$campaign = new Campaign();
		$campaign->admin_id = auth()->guard('admin')->user()->admin_id;
		$campaign->location_id = $params['location_id'];
		$campaign->language_id = $params['language_id'];
		$campaign->campaign_name = $params['campaign_name'];
		$campaign->monthly_searches = $params['monthly_searches'];
		$campaign->convert_null_to_zero = $params['convert_null_to_zero'];
		$campaign->added_on = Carbon::now();
		$campaign->save();
		
		foreach($keyword_results['data'] as $param_keyword) {
			$result_last_month = '';
			$keyword = new Keyword();
			$keyword->campaign_id = $campaign->campaign_id;
			$keyword->keyword_name = $param_keyword['keyword'];
			$keyword->search_volume = $param_keyword['search_volume'];
			$keyword->cpc = $param_keyword['cpc'];
			$keyword->competition = $param_keyword['competition'];
			if($param_keyword['targeted_monthly_searches'] != null) {
				foreach($param_keyword['targeted_monthly_searches'] as $result_month) {
					$result_last_month .= $result_month['year'].';'.$result_month['month'].';'.$result_month['count'].'||';
				}
			}
			\Log::debug($result_last_month);
			$keyword->target_monthly_search = $result_last_month;
			$keyword->save();
		}
			
		return $campaign;
	}
}