<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PrioritiesTranslation;

class Priorities extends Model
{
    protected $table = 'ticketit_priorities';
    /**
	 * @var string
	 */
	protected $primaryKey = 'id';
    protected $fillable = ['color'];
    /**
     * Indicates that this model should not be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * Get related tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /*public function tickets()
    {
        return $this->hasMany('Kordy\Ticketit\Models\Ticket', 'priority_id');
    }*/
    public function translation($language=null)
    {
        if($language==null){
            return $this->hasMany(PrioritiesTranslation::class,'priority_id');
        } else {
            return $this->hasOne(PrioritiesTranslation::class,'priority_id')->where('language_id',$language);
        }
    }

    public function english()
    {
        return $this->translation(1);
    }
    public function french()
    {
        return $this->translation(2);
    }
    public function getByLanguageId($language_id)
    {
        $priority_translation = $this->translation->filter(function ($value, $key) use ($language_id) {
            return ($value->language_id == $language_id);
        });
        return (count($priority_translation) == 0)?$this->translation()->first():$priority_translation->first();
    }
}
