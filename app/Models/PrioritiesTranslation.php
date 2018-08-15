<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrioritiesTranslation extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'ticketit_priorities_translation';

	protected $primaryKey = 'ticketit_priorities_translation_id';


	public $timestamps = false;
	protected $guarded = [];


	public function language()
	{
		return $this->belongsTo(Language::class,'language_id','language_id');
	}
}
