<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'keyword';
    protected $primaryKey = 'keyword_id';
    protected $fillable = ['campaign_id', 'keyword_name', 'search_volume', 'cpc', 'competition', 'target_monthly_search'];
    
    public $timestamps = false;
    
    public function campaign()
	{
		return $this->hasOne(Campaign::class,'campaign_id','campaign_id');
	}
}
