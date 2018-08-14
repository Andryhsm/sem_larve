<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoriesTranslation;

class Categories extends Model
{
    protected $table = 'ticketit_categories';
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
        return $this->hasMany('Kordy\Ticketit\Models\Ticket', 'category_id');
    }    */
    public function translation($language=null)
    {
        if($language==null){
            return $this->hasMany(CategoriesTranslation::class,'category_id');
        } else {
            return $this->hasOne(CategoriesTranslation::class,'category_id')->where('language_id',$language);
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
        $category_translation = $this->translation->filter(function ($value, $key) use ($language_id) {
            return ($value->language_id == $language_id);
        });
        return (count($category_translation) == 0)?$this->translation()->first():$category_translation->first();
    }
}
