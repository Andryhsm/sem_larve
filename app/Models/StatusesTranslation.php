<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusesTranslation extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'ticketit_statuses_translation';

	protected $primaryKey = 'ticketit_statuses_translation_id';


	public $timestamps = false;
	protected $guarded = [];


	public function language()
	{
		return $this->belongsTo(Language::class,'language_id','language_id');
	}
}
