<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'criteria_id';
    protected $fillable = ['location_name', 'canonical_name', 'parent_id', 'country_code', 'target_type', 'status'];
    public $timestamps = false;

    public function parent(){
		return $this->hasOne(Location::class, 'criteria_id', 'parent_id');
	}


}
