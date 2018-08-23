<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'keyword';
    protected $primaryKey = 'keyword_id';
    protected $fillable = ['campaign_id', 'keyword_name'];

    public function campaign()
	{
		return $this->hasOne(Campaign::class,'campaign_id','campaign_id');
	}
}
