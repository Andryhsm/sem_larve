<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'is_active',
        'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getProfileImage(){
        return URL::to('/').'/upload/profile/'.$this->profile_image;
    }
    public function role(){
        return $this->hasOne(AdminRole::class,'admin_role_id');
    }
    
    public function parent()
    {
        return $this->belongsToMany(Subaccount::class, 'subaccount', 'admin_id', 'admin_id');
    }
}
