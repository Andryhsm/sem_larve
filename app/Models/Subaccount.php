<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subaccount extends Model
{
    protected $table = 'subaccount';
	/**
	 * @var string
	 */
	protected $primaryKey = 'subaccount_id';
	protected $fillable = ['subadmin_id', 'admin_id'];

	public $timestamps = false;
}
