<?php

namespace App;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'store';
	/**
	 * @var string
	 */
	protected $primaryKey = 'store_id';

	const LOGO_IMG_PATH = 'upload/logo';
	const SHOP_IMG_PATH = 'upload/shop';


	public function users()
	{
		return $this->belongsToMany(User::class, 'store_users', 'store_id', 'user_id')->withPivot(['is_global_manager','compte_principal','receive_request','reply_request']);
	}

	public function brands()
	{
		return $this->belongsToMany(Brand::class, 'store_brands', 'store_id', 'brand_id');
	}

	public function requestBrand()
	{
		return $this->hasOne(RequestBrand::class,'store_id');
	}

	public function state()
	{
		return $this->hasOne(Region::class,'id','state_id');
	}
	public function country()
	{
		return $this->hasOne(Country::class,'id','country_id');
	}



}
