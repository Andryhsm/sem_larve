<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StatusesTranslation;

class Statuses extends Model
{
    protected $table = 'ticketit_statuses';
    /**
	 * @var string
	 */
	protected $primaryKey = 'id';
    protected $fillable = ['name', 'color'];
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
        return $this->hasMany('Kordy\Ticketit\Models\Ticket', 'status_id');
    }*/
    public function translation($language=null)
    {
        if($language==null){
            return $this->hasMany(StatusesTranslation::class,'status_id');
        } else {
            return $this->hasOne(StatusesTranslation::class,'status_id')->where('language_id',$language);
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
}
