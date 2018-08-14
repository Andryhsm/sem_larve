<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeAccount extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'stripe_account';
	/**
	 * @var string
	 */
	public $timestamps = false;
	
	protected $primaryKey = 'stripe_account_id';

	protected $fillable = ['stripe_account_name', 'publishable_key', 'secret_key', 'is_active'];
}
