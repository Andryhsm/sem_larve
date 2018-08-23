<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdwordsApi extends Model
{
    protected $table = 'adwords_api';
    /**
	 * @var string
	 */
	protected $primaryKey = 'adwords_api_id';
    protected $fillable = ['name','adwords_developper_token', 'adwords_client_id', 'adwords_client_secret', 'adwords_client_refresh_token', 'adwords_client_customer_id', 'adwords_user_agent', 'is_default', 'admin_id'];
    
}
