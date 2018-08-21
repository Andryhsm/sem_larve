<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Priorities;
use App\Models\Statuses;
use App\Models\TicketitComments;
use App\Models\Admin;
use App\User;

class Ticketit extends Model
{
    protected $table = 'ticketit';
    /**
	 * @var string
	 */
	protected $primaryKey = 'id';
    

    public function status()
    {
        return $this->belongsTo(Statuses::class, 'status_id');
    }

    public function priority()
    {
        return $this->belongsTo(Priorities::class, 'priority_id');
    }
 
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    
    public function comments()
    {
        return $this->hasMany(TicketitComments::class, 'ticket_id');
    }
    
}
