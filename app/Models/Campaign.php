<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaign';
    protected $primaryKey = 'campaign_id';
    protected $fillable = ['user_id', 'location_id', 'campaign_name', 'monthly_searches', 'convert_null_to_zero'];

    public function user()
	{
		return $this->hasOne(User::class,'user_id','user_id');
	}
	
	public function location()
	{
		return $this->hasOne(Location::class,'location_id','location_id');
	}
}
