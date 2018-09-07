<?php

namespace App\Models;

use App\Locations;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaign';
    protected $primaryKey = 'campaign_id';
    protected $fillable = ['admin_id', 'country_id', 'province_id', 'area_id', 'campaign_name', 'monthly_searches', 'convert_null_to_zero','language_id'];
	
	public $timestamps = false;
	
    public function user()
	{
		return $this->hasOne(Admin::class,'admin_id','admin_id');
	}
	
	public function area()
	{
		return $this->hasOne(Location::class,'criteria_id','area_id');
	}
	
	public function language()
	{
		return $this->hasOne(Language::class,'criteron_id','language_id');
	}

	public function locations() {
        return $this->belongsToMany(Locations::class, 'campaign_locations', 'criteria_id', 'campaign_id');
    }

	public function piecekeyword()
	{
		return $this->hasOne(Keyword::class,'campaign_id', 'campaign_id');
	}

}
