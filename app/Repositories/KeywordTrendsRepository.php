<?php

namespace App\Repositories;


use App\Models\Campaign;
use App\Models\Keyword;
use App\Locations;
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
		return $this->modelCampaign->with('area','language','user', 'piecekeyword')->where('admin_id',$id)->orderBy('campaign_id','desc')->get();
	}

	public function getKeywordByCampaignId($id)
	{
		return $this->modelKeyword->where('campaign_id',$id)->get();	
	}
	
	public function deleteCampaignById($id)
	{
		return $this->modelCampaign->destroy($id);
	}

	public function getCampaignById($id)
	{
		return $this->modelCampaign->with('area', 'area.parent', 'area.parent.parent','language')->where('campaign_id',$id)->first();
	}

	public function updateKeywordByCampaignId($params,$searchVolumes)
	{
		$delete_keyword = $this->modelKeyword->where('campaign_id', $params['campaign_id'])->delete($params['campaign_id']);
		
		$null = ($params['convert_null_to_zero'] == 1) ? 0 : 1; 

		foreach($searchVolumes as $results){
			foreach($results as $result) {
				$result_last_month = '';
				$keyword = new Keyword();
				$keyword->campaign_id = $params['campaign_id'];
				$keyword->keyword_name = $result['keyword'];
				$keyword->avg_monthly_searches = ($result['search_volume'] != null) ? $result['search_volume']: $null;
				//$keyword->c;	
				$keyword->cpc = ($result['cpc'] != null) ? $result['cpc'] : $null;
				$keyword->competition = ($result['competition'] != null) ? $result['competition'] : $null;
				if($result['targeted_monthly_searches'] != null) {
					foreach($result['targeted_monthly_searches'] as $result_month) {
						$result_last_month .= $result_month['year'].';'.$result_month['month'].';'.$result_month['count'].'||';
					}
				}
				$keyword->target_monthly_search = $result_last_month;
				$keyword->save();
			}
		}
	}

	public function storeDataCollection($input, $searchVolumes) 
	{

		//$keywords_tab = json_decode($input['keywords_result']);
		$params = $input['params'];
		$campaign = new Campaign();
		$campaign->admin_id = $user_id = get_user_id();
		$campaign->country_id = $params['country_id'];
		$campaign->province_id = $params['province_id'];



		$campaign->language_id = $params['language_id'];
		$campaign->campaign_name = $params['campaign_name'];
		$campaign->monthly_searches = $params['monthly_searches'];
		$campaign->convert_null_to_zero = $params['convert_null_to_zero'];
		$campaign->added_on = Carbon::now();
		$campaign->save();

        $locations = Locations::find($params['area_id']);
        $campaign->locations()->attach($locations);

        //\Log::debug($campaign->locations());
	//	\Log::debug($locations);


		$null = ($params['convert_null_to_zero'] == 1) ? 0 : 1;
		//$data = $keywords_tab->data;
		
		//foreach ($data as $block_result) {
		foreach ($searchVolumes as $block_result) {
			foreach($block_result as $param_keyword) {
				$result_last_month = '';
				$keyword = new Keyword();
				$keyword->campaign_id = $campaign->campaign_id;
				$keyword->keyword_name = $param_keyword['keyword'];
				$keyword->avg_monthly_searches = ($param_keyword['search_volume'] != null) ? $param_keyword['search_volume'] : $null;
				//$keyword->c;

				$keyword->cpc = ($param_keyword['search_volume'] != null) ? $param_keyword['cpc'] : $null;
				$keyword->competition = ($param_keyword['competition'] != null ) ? $param_keyword['competition'] : $null;
				if($param_keyword['targeted_monthly_searches'] != null) {
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

	public function getDataCollectionNumberInMemory($id) {
		return $this->modelCampaign->where('admin_id', $id)->count();
	}

	public function getKeywordNumberByCampaignId($id) {
		return $this->modelKeyword->where('campaign_id',$id)->count();
	}

	public function getKeywordNumberTracked($id) {
			return $this->modelKeyword->where('campaign_id',$id)->count();
	}

	public function getLastDataCollection($id) {
		return $this->modelCampaign->with('area','language','user')->where('admin_id',$id)->orderBy('campaign_id','desc')->limit(12)->get();
	}

}