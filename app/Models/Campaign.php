<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaign';
    protected $primaryKey = 'campaign_id';
    protected $fillable = ['user_id', 'campaign_name', 'campaign_description'];

    public function user()
	{
		return $this->hasOne(User::class,'user_id','user_id');
	}
}
