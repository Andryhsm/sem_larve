<?php

namespace App\Repositories;


use App\Models\Campaign;
use App\Models\Keyword;

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
		return $this->modelCampaign->where('admin_id',$id)->orderBy('campaign_id')->get();
	}

	public function getKeywordByCampaignId($id)
	{
		return $this->modelKeyword->where('campaign_id',$id)->get();	
	}

}