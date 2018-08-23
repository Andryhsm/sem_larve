<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'locations';
	/**
	 * @var string
	 */
	protected $primaryKey = 'criteria_id';
	/**
	 * @var array
	 */
	protected $fillable = ['location_name', 'canonical_name', 'parent_id', 'country_code', 'target_type', 'status'];

    public $timestamps = false;
}
