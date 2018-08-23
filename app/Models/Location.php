<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';
    protected $primaryKey = 'location_id';
    protected $fillable = ['location_name', 'canonical_name', 'parent_id', 'country_code', 'target_type', 'status'];
    public $timestamps = false;

}
