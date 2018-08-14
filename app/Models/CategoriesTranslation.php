<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesTranslation extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'ticketit_categories_translation';

	protected $primaryKey = 'ticketit_categories_translation_id';


	public $timestamps = false;
	protected $guarded = [];


	public function language()
	{
		return $this->belongsTo(Language::class,'language_id','language_id');
	}
}
