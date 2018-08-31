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
		
		$keywords_result = $input['keywords_result'];
		$params = $input['params'];
		
		$campaign = new Campaign();
		$campaign->admin_id = $user_id = get_user_id();
		$campaign->country_id = $params['country_id'];
		$campaign->province_id = $params['province_id'];
		$campaign->area_id = $params['area_id'];
		$campaign->language_id = $params['language_id'];
		$campaign->campaign_name = $params['campaign_name'];
		$campaign->monthly_searches = $params['monthly_searches'];
		$campaign->convert_null_to_zero = $params['convert_null_to_zero'];
		$campaign->added_on = Carbon::now();
		$campaign->save();
		
		$null = ($params['convert_null_to_zero'] == 1) ? 0 : 1; 
		$data = $keywords_result['data'];
		
		foreach ($data as $block_result) {
		
			foreach($block_result as $param_keyword) {
				$result_last_month = '';
				$keyword = new Keyword();
				$keyword->campaign_id = $campaign->campaign_id;
				$keyword->keyword_name = $param_keyword['keyword'];
				$keyword->avg_monthly_searches = isset($param_keyword['search_volume']) ? $param_keyword['search_volume'] : $null;
				$keyword->c;
				$keyword->cpc = isset($param_keyword['search_volume']) ? $param_keyword['cpc'] : $null;
				$keyword->competition = isset($param_keyword['competition']) ? $param_keyword['competition'] : $null;
				if(isset($param_keyword['targeted_monthly_searches'])) {
					foreach($param_keyword['targeted_monthly_searches'] as $result_month) {
						$result_last_month .= $result_month['year'].';'.$result_month['month'].';'.$result_month['count'].'||';
					}
				}
				$keyword->target_monthly_search = $result_last_month;
				$keyword->save();
			}
		}

		
			
		return $campaign;
	}
}