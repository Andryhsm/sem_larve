<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaign';
    protected $primaryKey = 'campaign_id';
    protected $fillable = ['admin_id', 'location_id', 'campaign_name', 'monthly_searches', 'convert_null_to_zero'];

    public function user()
	{
		return $this->hasOne(Admin::class,'admin_id','admin_id');
	}
	
	// public function location()
	// {
	// 	return $this->hasOne(Location::class,'location_id','location_id');
	// }
}
