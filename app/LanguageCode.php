<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageCode extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'languagecode';
	/**
	 * @var string
	 */
	protected $primaryKey = 'criteron_id';
	/**
	 * @var array
	 */
	protected $fillable = ['language_name', 'language_code'];
	
	public $timestamps = false;

}
