<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	/**
	 * @var string
	 */
    const FRENCH_CODE='fr';
	protected $table = 'languagecode';
	/**
	 * @var string
	 */
	protected $primaryKey = 'criteron_id';

	public $timestamps = false;
}
