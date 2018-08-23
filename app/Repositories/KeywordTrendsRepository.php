<?php

namespace App\Repositories;


use App\Models\Campaign;

class KeywordTrendsRepository
{
	protected $modelCampaign;

	public function __construct(Campaign $campaign)
	{
		$this->modelCampaign = $campaign;
	}

	public function getAllByUser($id)
	{
		return $this->modelCampaign->where('admin_id',$id)->orderBy('campaign_id')->get();
	}

	

}