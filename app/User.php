<?php

namespace App;

use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'name', 'email', 'password', 'civility', 'language',
    ];

    public static $manage_account_rules = ['first_name'      => 'Required',
        'last_name'       => 'Required',
        'email_address'   => 'Required|Email',
       ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->hasOne(Role::class,'role_id','role_id');
    }

	public function address()
	{
		return $this->hasOne(UserAddress::class, 'user_id','user_id');
	}

    public function store()
    {
        return $this->belongsToMany(Store::class, 'store_users','user_id','store_id');
    }

    public function language()
    {
        return $this->hasOne(Language::class, 'language_id', 'language_id');
    }
    
}
