<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'keyword';
    protected $primaryKey = 'keyword_id';
    protected $fillable = ['campaign_id', 'keyword_name', 'cpc', 'competition', 'target_monthly_search', 'currency', 'avg_monthly_searches', 'low_range_top_of_page_bid', 'high_range_top_of_page_bid', 'ad_impression_share', 'organic_impression_share', 'organic_average_position', 'in_account', 'in_plan'];
    
    public $timestamps = false;
    
    public function campaign()
	{
		return $this->hasOne(Campaign::class,'campaign_id','campaign_id');
	}
}
